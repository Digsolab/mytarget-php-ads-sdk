<?php

namespace MyTarget\Token;

use GuzzleHttp\Psr7\Request;
use MyTarget\Token\ClientCredentials\CredentialsProvider;
use MyTarget\Token\Exception\TokenDeletedException;
use MyTarget\Token\Exception\TokenLimitReachedException;
use MyTarget\Token\Exception\TokenRequestException;
use MyTarget\Transport\HttpTransport;
use Psr\Http\Message\RequestInterface;
use MyTarget as f;
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
     * @param \DateTime $now
     * @param string|null $username
     * @param array $context
     *
     * @return Token|null
     *
     * @throws TokenRequestException
     */
    public function acquire(RequestInterface $request, \DateTime $now, $username = null, array $context = null)
    {
        $credentials = $this->credentials->getCredentials($request, $context);
        $uri = $this->baseAddress->withPath(self::TOKEN_URL);

        // @todo переписать на Operator
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

        if ($response->getStatusCode() === HttpTransport::STATUS_ACCESS_DENIED
            && false !== strpos($body, 'limit reached')
        ) {
            throw new TokenLimitReachedException(sprintf("Reason phrase: %s\nBody: %s", $response->getReasonPhrase(), $body));
        }

        if ($response->getStatusCode() !== HttpTransport::STATUS_OK) {
            throw TokenRequestException::forCredentials($tokenRequest, $response, $username);
        }

        $tokenArray = f\json_decode($body);
        $token = Token::fromResponse($tokenArray, $now);

        if ($token === null) {
            throw TokenRequestException::invalidResponse($tokenRequest, $response, $username);
        }

        return $token;
    }

    /**
     * @param RequestInterface $request
     * @param \DateTime $now
     * @param string $refreshToken
     * @param array|null $context
     *
     * @return Token|null
     *
     * @throws TokenRequestException
     */
    public function refresh(RequestInterface $request, \DateTime $now, $refreshToken, array $context = null)
    {
        $credentials = $this->credentials->getCredentials($request, $context);
        $uri = $this->baseAddress->withPath(self::TOKEN_URL);

        // @todo переписать на Operator
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

        if ($response->getStatusCode() === HttpTransport::STATUS_UNAUTHORIZED
            && false !== strpos($body, 'deleted')
        ) {
            throw new TokenDeletedException(sprintf("Reason phrase: %s\nBody: %s", $response->getReasonPhrase(), $body));
        }

        if ($response->getStatusCode() !== HttpTransport::STATUS_OK) {
            throw TokenRequestException::refreshFailed($tokenRequest, $response);
        }

        $tokenArray = f\json_decode($body);
        $token = Token::fromResponse($tokenArray, $now);

        if ($token === null) {
            throw TokenRequestException::invalidResponse($tokenRequest, $response);
        }

        return $token;
    }
}
