<?php

namespace Dsl\MyTarget\Transport;

use Dsl\MyTarget\Transport\Exception\NetworkException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpTransport
{
    /**
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return ResponseInterface
     * @throws NetworkException
     */
    public function request(RequestInterface $request, array $context = null);
}
