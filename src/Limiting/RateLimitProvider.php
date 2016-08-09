<?php

namespace Dsl\MyTarget\Limiting;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RateLimitProvider
{
    /**
     * @param string $limitBy
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return bool
     */
    public function isLimitReached($limitBy, RequestInterface $request, array $context = null);

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string $limitBy
     * @param array|null $context
     */
    public function refreshLimits(RequestInterface $request, ResponseInterface $response, $limitBy, array $context = null);
}
