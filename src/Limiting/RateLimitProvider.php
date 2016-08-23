<?php

namespace Dsl\MyTarget\Limiting;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RateLimitProvider
{
    /**
     * Should return amount of seconds one needs to wait until this type of request can be done.
     * Otherwise should return false if we are can issue a request at this point.
     *
     * @param string $limitBy
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return int|bool
     */
    public function rateLimitTimeout($limitBy, RequestInterface $request, array $context = null);

    /**
     * Will look into the response headers and try to find X-RateLimit-* headers and save them somewhere
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string $limitBy
     * @param array|null $context
     */
    public function refreshLimits(RequestInterface $request, ResponseInterface $response, $limitBy, array $context = null);
}
