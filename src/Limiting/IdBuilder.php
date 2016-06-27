<?php

namespace MyTarget\Limiting;

use Psr\Http\Message\RequestInterface;

interface IdBuilder
{
    /**
     * @param RequestInterface $request
     * @param string|null      $username
     *
     * @return string
     */
    public function buildId(RequestInterface $request, $username = null);
}
