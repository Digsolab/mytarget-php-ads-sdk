<?php

namespace Dsl\MyTarget\Limiting;

use Dsl\MyTarget\Limiting\Exception as Ex;
use Dsl\MyTarget\Transport\Middleware\HttpMiddleware;
use Dsl\MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use Dsl\MyTarget\Exception\DecodingException;
use Dsl\MyTarget as f;
use Dsl\MyTarget\Context;

class LimitingMiddleware implements HttpMiddleware
{
    const HTTP_STATUS_LIMIT_REACHED = 429;

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
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, Context $context = null)
    {
        if ( ! $context || ! $context->getLimitBy()) {
            return $stack->request($request, $context);
        }

        $limitBy = $context->getLimitBy();

        $timeout = $this->rateLimitProvider->rateLimitTimeout($limitBy, $request, $context);

        if ($timeout) {
            throw new Ex\ThrottleException($timeout, "Preventively throttled: limit had been reached", $request);
        }

        $response = $stack->request($request, $context);

        $this->rateLimitProvider->refreshLimits($request, $response, $limitBy, $context);

        if ($response->getStatusCode() === self::HTTP_STATUS_LIMIT_REACHED) {
            if (strpos((string)$response->getBody(), 'banners limit') !== false) {
                throw new Ex\BannerLimitException('Banners limit exceeded');
            }
            try {
                $decoded = f\json_decode((string)$response->getBody());
            } catch (DecodingException $e) { }

            if (isset($decoded["remaining"], $decoded["limits"])) {
                $timeout = $this->rateLimitProvider->rateLimitTimeout($limitBy, $request, $context);
                throw new Ex\ThrottleException($timeout ?: null, "Throttle response: limit had been reached", $request, $response);
            }
        }

        return $response;
    }
}
