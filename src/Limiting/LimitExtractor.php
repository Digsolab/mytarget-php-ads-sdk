<?php

namespace Dsl\MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

interface LimitExtractor
{
    /**
     * @param ResponseInterface  $response
     * @param \DateTimeInterface $moment
     *
     * @return Limits
     */
    public function extractLimits(ResponseInterface $response, \DateTimeInterface $moment);
}
