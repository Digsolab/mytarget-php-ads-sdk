<?php

namespace MyTarget\Token;

use GuzzleHttp\Psr7\Request;
use MyTarget\Token\ClientCredentials\CredentialsProvider;
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

        if ($response->getStatusCode() !== 200) {
            throw TokenRequestException::forCredentials($tokenRequest, $response, $username);
        }

        $tokenArray = f\json_decode((string)$response->getBody());
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

        if ($response->getStatusCode() !== 200) {
            throw TokenRequestException::refreshFailed($tokenRequest, $response);
        }

        $tokenArray = f\json_decode((string)$response->getBody());
        $token = Token::fromResponse($tokenArray, $now);

        if ($token === null) {
            throw TokenRequestException::invalidResponse($tokenRequest, $response);
        }

        return $token;
    }
}
