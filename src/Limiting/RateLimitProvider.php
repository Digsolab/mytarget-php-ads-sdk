<?php

namespace MyTarget\Limiting;

use MyTarget\Limiting\Exception\ThrottleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RateLimitProvider
{
    /**
     * @param RequestInterface $request
     * @param string|null       $username
     *
     * @throws ThrottleException
     */
    public function throttleIfNeeded(RequestInterface $request, $username = null);

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param string|null       $username
     */
    public function updateLimits(RequestInterface $request, ResponseInterface $response, $username = null);
}
