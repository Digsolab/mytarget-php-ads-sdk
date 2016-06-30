<?php

namespace MyTarget\Transport\Middleware\Impl;

use MyTarget\Transport\Exception as ex;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;

class ResponseValidatingMiddleware implements HttpMiddleware
{
    /**
     * @inheritdoc
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        $response = $stack->request($request, $context);
        $code = $response->getStatusCode();

        if ($code >= 500 && $code < 600) {
            throw new ex\ServerErrorException("MyTarget: {$code} Server Error", $request, $response);
        }

        if ($code >= 400 && $code < 500) {
            throw new ex\ClientErrorException("MyTarget: {$code} Client Error", $request, $response);
        }

        if ($code >= 300 && $code < 400) { // safety net
            throw new ex\RequestException("MyTarget: {$code} Redirect is not supported", $request, $response);
        }

        return $response;
    }
}
