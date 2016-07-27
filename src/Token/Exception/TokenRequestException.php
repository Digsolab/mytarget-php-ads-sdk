<?php

namespace MyTarget\Token\Exception;

use MyTarget\Exception\MyTargetException;
use MyTarget\Transport\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class TokenRequestException extends RequestException implements MyTargetException
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @return static
     */
    public static function refreshFailed(RequestInterface $request, ResponseInterface $response)
    {
        $message = sprintf("Couldn't refresh token, response code: %d", $response->getStatusCode());

        return new static($message, $request, $response);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string|null $username
     *
     * @return static
     */
    public static function forCredentials(RequestInterface $request, ResponseInterface $response, $username = null)
    {
        if ($username !== null) {
            $message = sprintf("Couldn't get new token for a client with username %s, response code: %d",
                $username, $response->getStatusCode());
        } else {
            $message = sprintf("Couldn't get new token for credentials, response code: %d", $response->getStatusCode());
        }

        return new static($message, $request, $response);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string|null $username
     *
     * @return static
     */
    public static function invalidResponse(RequestInterface $request, ResponseInterface $response, $username = null)
    {
        if ($username !== null) {
            $message = "Couldn't parse token response";
        } else {
            $message = sprintf("Couldn't parse token response for username %s", $username);
        }

        return new static($message, $request, $response);
    }
}
