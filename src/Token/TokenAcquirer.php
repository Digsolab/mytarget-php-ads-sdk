<?php

namespace Dsl\MyTarget\Token;

use GuzzleHttp\Psr7\Request;
use Dsl\MyTarget\Token\ClientCredentials\CredentialsProvider;
use Dsl\MyTarget\Token\Exception\TokenDeletedException;
use Dsl\MyTarget\Token\Exception\TokenLimitReachedException;
use Dsl\MyTarget\Token\Exception\TokenRequestException;
use Dsl\MyTarget\Transport\HttpTransport;
use Psr\Http\Message\RequestInterface;
use Dsl\MyTarget as f;
use GuzzleHttp\Psr7 as guzzle;
use Psr\Http\Message\UriInterface;

class TokenAcquirer
{
    const TOKEN_URL = "/api/v2/oauth2/token.json";

    /**
     * @var UriInterface
     */
    private $baseAddress;

    /**
     * @var HttpTransport
     */
    private $http;

    /**
     * @var CredentialsProvider
     */
    private $credentials;

    public function __construct(UriInterface $baseAddress, HttpTransport $http, CredentialsProvider $credentials)
    {
        $this->baseAddress = $baseAddress;
        $this->http = $http;
        $this->credentials = $credentials;
    }

    /**
     * @param RequestInterface $request
     * @param \DateTimeInterface $now
     * @param string|null $username
     * @param array $context
     *
     * @return Token|null
     *
     * @throws TokenLimitReachedException
     * @throws TokenRequestException
     */
    public function acquire(RequestInterface $request, \DateTimeInterface $now, $username = null, array $context = null)
    {
        $credentials = $this->credentials->getCredentials($request, $context);
        $uri = $this->baseAddress->withPath(self::TOKEN_URL);

        $payload = [
            "grant_type" => $username === null ? "client_credentials" : "agency_client_credentials",
            "client_id" => $credentials->getClientId(),
            "client_secret" => $credentials->getClientSecret()
        ];

        if ($username !== null) {
            $payload["agency_client_name"] = $username;
        }

        $tokenRequest = new Request("POST", $uri,
            ["Content-Type" => "application/x-www-form-urlencoded"],
            guzzle\build_query($payload));

        $response = $this->http->request($tokenRequest, $context);

        $body = (string) $response->getBody();

        if ($response->getStatusCode() === 403 && false !== stripos($body, 'limit reached')) {
            throw TokenLimitReachedException::forCredentials($tokenRequest, $response, $username);
        }

        if ($response->getStatusCode() !== 200) {
            throw TokenRequestException::forCredentials($tokenRequest, $response, $username);
        }

        $tokenArray = f\json_decode($body);
        if (is_array($tokenArray)) {
            $token = Token::fromResponse($tokenArray, $now);
        }

        if (empty($token)) {
            throw TokenRequestException::invalidResponse($tokenRequest, $response, $username);
        }

        return $token;
    }

    /**
     * @param RequestInterface $request
     * @param \DateTimeInterface $now
     * @param string $refreshToken
     * @param array|null $context
     *
     * @return Token|null
     * @throws TokenRequestException
     */
    public function refresh(RequestInterface $request, \DateTimeInterface $now, $refreshToken, array $context = null)
    {
        $credentials = $this->credentials->getCredentials($request, $context);
        $uri = $this->baseAddress->withPath(self::TOKEN_URL);

        $payload = [
            "grant_type" => "refresh_token",
            "refresh_token" => $refreshToken,
            "client_id" => $credentials->getClientId(),
            "client_secret" => $credentials->getClientSecret()
        ];

        $tokenRequest = new Request("POST", $uri,
            ["Content-Type" => "application/x-www-form-urlencoded"],
            guzzle\build_query($payload));

        $response = $this->http->request($tokenRequest, $context);

        $body = (string) $response->getBody();

        if ($response->getStatusCode() === 401 && false !== stripos($body, 'deleted')) {
            throw TokenDeletedException::refreshFailed($tokenRequest, $response);
        }

        if ($response->getStatusCode() !== 200) {
            throw TokenRequestException::refreshFailed($tokenRequest, $response);
        }

        $tokenArray = f\json_decode($body);
        if (is_array($tokenArray)) {
            $token = Token::fromResponse($tokenArray, $now);
        }

        if (empty($token)) {
            throw TokenRequestException::invalidResponse($tokenRequest, $response);
        }

        return $token;
    }
}
