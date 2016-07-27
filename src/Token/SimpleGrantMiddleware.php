<?php

namespace MyTarget\Token;


use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;

class SimpleGrantMiddleware implements HttpMiddleware {

    /** @var Token  */
    private $token;

    /**
     * @param Token $token
     */
    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        /** @var RequestInterface $request */
        $request = $request->withHeader('Authorization', sprintf('Bearer %s', $this->token->getAccessToken()));

        return $stack->request($request, $context);
    }

}
