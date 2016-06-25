<?php

namespace MyTarget\Token\Exception;

use MyTarget\Exception\MyTargetException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class TokenRequestException extends \RuntimeException
    implements MyTargetException
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface|null
     */
    private $response;

    /**
     * @param string $message
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct($message, RequestInterface $request, ResponseInterface $response = null)
    {
        parent::__construct($message);

        $this->request = $request;
        $this->response = $response;
    }

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
     * @return ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}
