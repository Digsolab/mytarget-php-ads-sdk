<?php

namespace MyTarget\Transport\Middleware\Impl;

use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;

class CallbackMiddleware implements HttpMiddleware
{
    /**
     * @var callable callable(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null): ResponseInterface
     */
    private $callback;

    /**
     * @param callable $callback callable(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null): ResponseInterface
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @inheritdoc
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        return call_user_func($this->callback, $request, $stack, $context);
    }
}
