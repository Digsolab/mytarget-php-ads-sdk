<?php

namespace MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

interface LimitExtractor
{
    /**
     * @param ResponseInterface $response
     *
     * @return int[]
     */
    public function extractLimits(ResponseInterface $response);
}
