<?php

namespace MyTarget\Token;

use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use MyTarget as f;
use GuzzleHttp\Psr7 as guzzle;

class ClientGrantMiddleware implements HttpMiddleware
{
    /**
     * @var TokenManager
     */
    private $tokens;

    public function __construct(TokenManager $tokens)
    {
        $this->tokens = $tokens;
    }

    /**
     * @inheritdoc
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        if (isset($context["username"])) {
            $token = $this->tokens->getClientToken($request, $context["username"], $context);
        } else {
            $token = $this->tokens->getToken($request, $context);
        }

        $request = $request->withHeader("Authorization", sprintf("Bearer %s", $token->getAccessToken()));
        /** @var RequestInterface $request */

        return $stack->request($request, $context);
    }
}
