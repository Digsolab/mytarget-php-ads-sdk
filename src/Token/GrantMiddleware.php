<?php

namespace MyTarget\Token;

use MyTarget\Token\Exception\TokenLimitReachedException;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use MyTarget as f;
use GuzzleHttp\Psr7 as guzzle;
use MyTarget\Token\Exception\TokenLockException;
use MyTarget\Token\Exception\TokenRequestException;

class GrantMiddleware implements HttpMiddleware
{
    /** @var TokenManager  */
    private $tokens;

    /**
     * @param TokenManager $tokens
     */
    public function __construct(TokenManager $tokens) {
        $this->tokens = $tokens;
    }

    /**
     * @inheritdoc
     *
     * @throws TokenLockException
     * @throws TokenLimitReachedException
     * @throws TokenRequestException
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        if (empty($context['username'])) {
            $client = $this->tokens->getAcquirer()->getCredentials()->getCredentials($request, $context)->getClientId();
            $token = $this->tokens->getClientToken($request, $client, $context);
        } else {
            $token = $this->tokens->getUserToken($request, $context['username'], $context);

        }

        /** @var RequestInterface $request */
        $request = $request->withHeader('Authorization', sprintf('Bearer %s', $token->getAccessToken()));

        return $stack->request($request, $context);
    }
}
