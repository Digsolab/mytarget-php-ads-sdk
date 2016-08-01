<?php

namespace MyTarget\Transport;

use MyTarget\Transport\Exception\HttpTransportException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpTransport
{
    /**
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return ResponseInterface
     * @throws HttpTransportException
     */
    public function request(RequestInterface $request, array $context = null);
}
