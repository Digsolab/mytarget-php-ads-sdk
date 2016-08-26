<?php

namespace Dsl\MyTarget\Transport\Middleware\Impl;

use Dsl\MyTarget\Transport\HttpTransport;
use Dsl\MyTarget\Transport\Middleware\HttpMiddleware;
use Dsl\MyTarget\Transport\Middleware\HttpMiddlewareStack;
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
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        return $this->http->request($request, $context);
    }
}
