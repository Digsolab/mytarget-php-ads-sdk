<?php

namespace MyTarget\Limiting;

use MyTarget\Limiting\Exception\ThrottleException;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use MyTarget\Exception\DecodingException;
use MyTarget as f;

class LimitingMiddleware implements HttpMiddleware
{
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
        if ( ! is_array($context) || ! isset($context["limit-by"])) {
            return $stack->request($request, $context);
        }

        $limitBy = $context["limit-by"];

        $isLimitReached = $this->rateLimitProvider->isLimitReached($limitBy, $request, $context);

        if ($isLimitReached) {
            throw new ThrottleException("Preventively throttled: limit had been reached", $request);
        }

        $response = $stack->request($request, $context);

        $this->rateLimitProvider->refreshLimits($request, $response, $limitBy, $context);

        if ($response->getStatusCode() === 429) {
            try {
                $decoded = f\json_decode((string)$response->getBody());
            } catch (DecodingException $e) { }

            if (isset($decoded["remaining"], $decoded["limits"])) {
                throw new ThrottleException("Throttle response: limit had been reached", $request, $response);
            }
        }

        return $response;
    }
}
