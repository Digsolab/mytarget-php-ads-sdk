<?php

namespace Dsl\MyTarget\Transport\Middleware;

use Dsl\MyTarget\Context;
use Dsl\MyTarget\Transport\HttpTransport;
use Dsl\MyTarget\Transport\Middleware\Impl\TerminatingMiddleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpMiddlewareStack
{
    /**
     * @var \SplStack|HttpMiddleware[]
     */
    protected $middlewares;

    /**
     * @var HttpTransport
     */
    protected $http;

    /**
     * @param \SplStack|HttpMiddleware[] $middlewares
     * @param HttpTransport $http
     */
    public function __construct(\SplStack $middlewares, HttpTransport $http)
    {
        $this->middlewares = clone $middlewares;
        $this->http = $http;
    }

    /**
     * @param RequestInterface $request
     * @param Context|null $context
     *
     * @return ResponseInterface
     */
    public function request(RequestInterface $request, Context $context = null)
    {
        return $this->pop()->request($request, $this, $context);
    }

    /**
     * @return HttpMiddleware
     */
    private function pop()
    {
        return $this->middlewares->isEmpty() ? new TerminatingMiddleware($this->http) : $this->middlewares->pop();
    }
}
