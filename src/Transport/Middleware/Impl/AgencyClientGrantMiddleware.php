<?php

namespace MyTarget\Transport\Middleware\Impl;

use GuzzleHttp\Psr7\Request;
use MyTarget\Token\ClientCredentials\CredentialsProvider;
use MyTarget\Token\TokenStorage;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use MyTarget\Transport\Middleware\Impl\Exception\TokenRequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use MyTarget\Transport\HttpTransport;
use MyTarget\Token\Token;
use MyTarget as f;
use GuzzleHttp\Psr7 as guzzle;

class AgencyClientGrantMiddleware implements HttpMiddleware
{
    /**
     * @var HttpTransport
     */
    private $http;

    /**
     * @var TokenStorage
     */
    private $tokens;

    /**
     * @var CredentialsProvider
     */
    private $credentialsProvider;

    /**
     * @var UriInterface
     */
    private $baseAddress;

    /**
     * @var callable callable(): \DateTime Returns current moment
     */
    private $momentGenerator;

    /**
     * @param HttpTransport $http
     * @param TokenStorage $tokens
     * @param CredentialsProvider $credentialsProvider
     * @param UriInterface $baseAddress
     */
    public function __construct(HttpTransport $http, TokenStorage $tokens,
                                CredentialsProvider $credentialsProvider, UriInterface $baseAddress)
    {
        $this->http = $http;
        $this->tokens = $tokens;
        $this->credentialsProvider = $credentialsProvider;
        $this->baseAddress = $baseAddress;
        $this->momentGenerator = function () {
            return new \DateTime();
        };
    }

    /**
     * @param callable $cb
     */
    public function setMomentGenerator(callable $cb)
    {
        $this->momentGenerator = $cb;
    }

    /**
     * TODO review this file and make it more digestible/split into another class
     *
     * @inheritdoc
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, $username = null, $context = null)
    {
        $now = call_user_func($this->momentGenerator);

        if ($username !== null) {
            $token = $this->tokens->getClientToken($username, $request, $context);
        } else {
            $token = $this->tokens->getToken($request, $context);
        }

        if ($token === null || $token->isExpiredAt($now)) {
            $token = $this->requestToken($request, $now, $username, $context);

            if ($username !== null) {
                $this->tokens->updateClientToken($username, $token, $request, $context);
            } else {
                $this->tokens->updateToken($token, $request, $context);
            }
        }

        $request = $request->withHeader("Authorization", sprintf("Bearer %s", $token->getAccessToken()));
        /** @var RequestInterface $request */

        $response = $stack->request($request, $context);

        if ($response->getStatusCode() !== 401) {
            return $response;
        }

        if ($response->getStatusCode() === 401) {
            $token = $this->requestToken($request, $now, $username, $context);

            if ($username !== null) {
                $this->tokens->updateClientToken($username, $token, $request, $context);
            } else {
                $this->tokens->updateToken($token, $request, $context);
            }
        }

        $request = $request->withHeader("Authorization", sprintf("Bearer %s", $token->getAccessToken()));

        return $stack->request($request, $context);
    }

    /**
     * @param RequestInterface $request
     * @param \DateTime $now
     * @param string $username
     * @param mixed $context
     *
     * @return Token|null
     */
    private function requestToken(RequestInterface $request, \DateTime $now, $username, $context)
    {
        $credentials = $this->credentialsProvider->getCredentials($request, $context);
        $uri = $this->baseAddress->withPath("/api/v2/oauth2/token.json");

        if ($username !== null) {
            $tokenRequest = new Request("POST", $uri, ["Content-Type" => "application/x-www-form-urlencoded"],
                guzzle\build_query([
                    "grant_type" => "agency_client_credentials",
                    "client_id" => $credentials->getClientId(),
                    "client_secret" => $credentials->getClientSecret(),
                    "agency_client_name" => $username
                ]));
        } else {
            $tokenRequest = new Request("POST", $uri, ["Content-Type" => "application/x-www-form-urlencoded"],
                guzzle\build_query([
                    "grant_type" => "client_credentials",
                    "client_id" => $credentials->getClientId(),
                    "client_secret" => $credentials->getClientSecret()
                ]));
        }

        $tokenResponse = $this->http->request($tokenRequest, $context);

        if ($tokenResponse->getStatusCode() !== 200) {
            throw TokenRequestException::forCredentials($tokenRequest, $tokenResponse, $username);
        }

        $tokenArray = f\json_decode((string)$tokenResponse->getBody());
        $token = Token::fromResponse($tokenArray, $now);

        if ($token === null) {
            throw TokenRequestException::invalidResponse($tokenRequest, $tokenResponse, $username);
        }

        return $token;
    }
}
