<?php

namespace MyTarget\Transport\Middleware\Impl;

use MyTarget\Transport\HttpTransport;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;

class TerminatingMiddleware implements HttpMiddleware
{
    /**
     * @var HttpTransport
     */
    private $http;

    public function __construct(HttpTransport $http)
    {
        $this->http = $http;
    }

    /**
     * @inheritdoc
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, $username = null, $context = null)
    {
        return $this->http->request($request, $context);
    }
}
