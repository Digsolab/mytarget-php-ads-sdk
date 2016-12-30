<?php

namespace Dsl\MyTarget\Limiting;

use Dsl\MyTarget\Context;
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
     * @param Context $context
     *
     * @return int|bool
     */
    public function rateLimitTimeout($limitBy, RequestInterface $request, Context $context);

    /**
     * Will look into the response headers and try to find X-RateLimit-* headers and save them somewhere
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string $limitBy
     * @param Context $context
     */
    public function refreshLimits(RequestInterface $request, ResponseInterface $response, $limitBy, Context $context);
}
