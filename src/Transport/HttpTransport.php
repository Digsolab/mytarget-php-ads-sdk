<?php

namespace MyTarget\Transport;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpTransport
{
    /**
     * @param RequestInterface $request
     * @param null $context
     *
     * @return ResponseInterface
     */
    public function request(RequestInterface $request, $context = null);
}
