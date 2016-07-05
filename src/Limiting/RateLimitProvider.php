<?php

namespace MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

interface RateLimitProvider
{
    /**
     * @param string            $limitBy
     * @param string|null       $username
     *
     * @return bool
     */
    public function isLimitReached($limitBy, $username = null);

    /**
     * @param ResponseInterface $response
     * @param string            $limitBy
     * @param string|null       $username
     */
    public function refreshLimits(ResponseInterface $response, $limitBy, $username = null);
}
