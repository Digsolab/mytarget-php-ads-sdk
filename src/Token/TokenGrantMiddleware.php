<?php

namespace Dsl\MyTarget\Token;

use Dsl\MyTarget\Context;
use Dsl\MyTarget\Token\Exception\TokenLimitReachedException;
use Dsl\MyTarget\Transport\Middleware\HttpMiddleware;
use Dsl\MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use Dsl\MyTarget\Token\Exception\TokenLockException;
use Dsl\MyTarget\Token\Exception\TokenRequestException;

class TokenGrantMiddleware implements HttpMiddleware
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
     *
     * @throws TokenLockException
     * @throws TokenLimitReachedException
     * @throws TokenRequestException
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, Context $context)
    {
        $token = $this->tokens->getToken($request, $context);

        /** @var RequestInterface $request */
        $request = $request->withHeader('Authorization', sprintf('Bearer %s', $token->getAccessToken()));

        return $stack->request($request, $context);
    }
}
