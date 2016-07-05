<?php

namespace MyTarget\Limiting;

use MyTarget\Transport\Middleware\Impl\Exception\ThrottleException;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;

class LimitingMiddleware implements HttpMiddleware
{
    private static $contextKey = "limit-by";

    /**
     * @var RateLimitProvider
     */
    private $rateLimitProvider;

    public function __construct(RateLimitProvider $rateLimitProvider)
    {
        $this->rateLimitProvider = $rateLimitProvider;
    }

    /**
     * @inheritdoc
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        if (!is_array($context) || !array_key_exists(self::$contextKey, $context)) {
            return $stack->request($request, $context);
        }
        
        $limitBy = $context[self::$contextKey];
        $username = isset($context["username"]) ? $context["username"] : null;

        $isLimitReached = $this->rateLimitProvider->isLimitReached($limitBy, $username);

        if ($isLimitReached) {
            throw new ThrottleException();
        }

        $response = $stack->request($request, $context);

        $this->rateLimitProvider->refreshLimits($response, $limitBy, $username);

        return $response;
    }
}
