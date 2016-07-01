<?php

namespace MyTarget\Transport;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpTransport
{
    /**
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return ResponseInterface
     */
    public function request(RequestInterface $request, array $context = null);
}
