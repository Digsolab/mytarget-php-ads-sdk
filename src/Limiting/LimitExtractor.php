<?php

namespace Dsl\MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

interface LimitExtractor
{
    /**
     * @param ResponseInterface $response
     * @param callable|null     $momentGenerator
     *
     * @return Limits
     */
    public function extractLimits(ResponseInterface $response, callable $momentGenerator = null);
}
