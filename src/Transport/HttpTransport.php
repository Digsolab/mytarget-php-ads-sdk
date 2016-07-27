<?php

namespace MyTarget\Transport;

use MyTarget\Transport\Exception\ConnectException;
use MyTarget\Transport\Exception\RequestException;
use MyTarget\Transport\Exception\TooManyRedirectsException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpTransport
{
    const STATUS_OK = 200;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_ACCESS_DENIED = 403;

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
