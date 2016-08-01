<?php

namespace MyTarget\Transport\Middleware;

use MyTarget\Transport\HttpTransport;

class HttpMiddlewareStackPrototype extends HttpMiddlewareStack
{
    /**
     * @param HttpMiddleware[] $middlewares
     * @param HttpTransport $http
     *
     * @return HttpMiddlewareStackPrototype
     */
    public static function fromArray(array $middlewares, HttpTransport $http)
    {
        $stack = new \SplStack();
        array_map([$stack, 'push'], $middlewares);

        return new HttpMiddlewareStackPrototype($stack, $http);
    }

    /**
     * @param HttpTransport $http
     *
     * @return HttpMiddlewareStackPrototype
     */
    public static function newEmpty(HttpTransport $http)
    {
        return new HttpMiddlewareStackPrototype(new \SplStack(), $http);
    }

    /**
     * @return HttpMiddlewareStack
     */
    public function freeze()
    {
        return new HttpMiddlewareStack(clone $this->middlewares, $this->http);
    }

    /**
     * @param HttpMiddleware $middleware
     */
    public function push(HttpMiddleware $middleware)
    {
        $this->middlewares->push($middleware);
    }
}
