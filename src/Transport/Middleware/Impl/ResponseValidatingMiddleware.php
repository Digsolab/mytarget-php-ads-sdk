<?php

namespace Dsl\MyTarget\Transport\Middleware\Impl;

use Dsl\MyTarget\Limiting\LimitingMiddleware;
use Dsl\MyTarget\Transport\Exception as ex;
use Dsl\MyTarget\Transport\Middleware\HttpMiddleware;
use Dsl\MyTarget\Transport\Middleware\HttpMiddlewareStack;
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

        // let's leave all the work with 429 to LimitingMiddleware
        if ($code === LimitingMiddleware::HTTP_STATUS_LIMIT_REACHED) {
            return $response;
        }

        if ($code >= 500 && $code < 600) {
            throw new ex\ServerErrorException("MyTarget: {$code} Server Error", $request, $response);
        }

        if ($code >= 400 && $code < 500) {
            throw ex\ClientErrorException::fromResponse($request, $response);
        }

        if ($code >= 300 && $code < 400) { // safety net
            throw new ex\RedirectUnexpectedException("MyTarget: {$code} Redirect is not supported", $request, $response);
        }

        return $response;
    }
}
