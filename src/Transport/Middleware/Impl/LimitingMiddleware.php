<?php

namespace MyTarget\Transport\Middleware\Impl;

use MyTarget\Limiting\RateLimitProvider;
use MyTarget\Transport\Middleware\Impl\Exception\ThrottleException;
use MyTarget\Transport\HttpTransport;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;

class LimitingMiddleware implements HttpMiddleware
{
    /**
     * @var HttpTransport
     */
    private $http;

    /**
     * @var RateLimitProvider
     */
    private $rateLimitProvider;

    public function __construct(HttpTransport $http, RateLimitProvider $rateLimitProvider)
    {
        $this->http = $http;
        $this->rateLimitProvider = $rateLimitProvider;
    }

    /**
     * @param RequestInterface $request
     * @param string|null $username
     * @param mixed|null $context
     *
     * @return ResponseInterface
     * @throws ThrottleException
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, $username = null, $context = null)
    {
        $isLimitReached = $this->rateLimitProvider->isLimitReached($request, $username);

        if ($isLimitReached) {
            throw new ThrottleException();
        }

        $response = $stack->request($request, $username, $context);

        $this->rateLimitProvider->refreshLimits($request, $response, $username);

        return $response;
    }
}
