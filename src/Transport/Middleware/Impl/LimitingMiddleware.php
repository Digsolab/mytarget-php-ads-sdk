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
    private static $contextKey = 'limit-by';
    
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
     * @param HttpMiddlewareStack $stack
     * @param string|null $username
     * @param array|null $context
     *
     * @return ResponseInterface
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, $username = null, array $context = null)
    {
        if (!is_array($context) || !array_key_exists(self::$contextKey, $context)) {
            return $stack->request($request, $username, $context);
        }
        
        $limitBy = $context[self::$contextKey];

        $isLimitReached = $this->rateLimitProvider->isLimitReached($limitBy, $username);

        if ($isLimitReached) {
            throw new ThrottleException();
        }

        $response = $stack->request($request, $username, $context);

        $this->rateLimitProvider->refreshLimits($response, $limitBy, $username);

        return $response;
    }
}
