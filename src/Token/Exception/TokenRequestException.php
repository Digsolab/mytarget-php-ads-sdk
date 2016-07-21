<?php

namespace MyTarget\Token\Exception;

use MyTarget\Transport\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class TokenRequestException extends RequestException
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return TokenRequestException
     */
    public static function refreshFailed(RequestInterface $request, ResponseInterface $response)
    {
        $message = sprintf("Couldn't refresh token, response code: %d", $response->getStatusCode());

        return new TokenRequestException($message, $request, $response);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string|null $username
     *
     * @return TokenRequestException
     */
    public static function forCredentials(RequestInterface $request, ResponseInterface $response, $username = null)
    {
        if ($username !== null) {
            $message = sprintf("Couldn't get new token for a client with username %s, response code: %d",
                $username, $response->getStatusCode());
        } else {
            $message = sprintf("Couldn't get new token for credentials, response code: %d", $response->getStatusCode());
        }

        return new TokenRequestException($message, $request, $response);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string|null $username
     *
     * @return TokenRequestException
     */
    public static function invalidResponse(RequestInterface $request, ResponseInterface $response, $username = null)
    {
        if ($username !== null) {
            $message = "Couldn't parse token response";
        } else {
            $message = sprintf("Couldn't parse token response for username %s", $username);
        }

        return new TokenRequestException($message, $request, $response);
    }

    /**
     * @param static $lockName
     * @param RequestInterface $request
     *
     * @return TokenRequestException
     */
    public static function temporaryLockFailed($lockName, RequestInterface $request)
    {
        return new self(sprintf('Could not obtain temporary cache lock: %s', $lockName), $request);
    }

    /**
     * @param string $lockName
     * @param RequestInterface $request
     *
     * @return TokenRequestException
     */
    public static function permanentLockFailed($lockName, RequestInterface $request)
    {
        return new self(sprintf('Could not obtain permanent cache lock: %s', $lockName), $request);
    }
}
