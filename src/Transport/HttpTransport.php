<?php

namespace MyTarget\Transport;

use MyTarget\Transport\Exception\ConnectException;
use MyTarget\Transport\Exception\RequestException;
use MyTarget\Transport\Exception\TooManyRedirectsException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpTransport
{
    /**
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return ResponseInterface
     * @throws ConnectException
     * @throws TooManyRedirectsException
     * @throws RequestException
     */
    public function request(RequestInterface $request, array $context = null);
}
