<?php

namespace MyTarget\Token;

use Doctrine\Common\Cache\Cache;
use MyTarget\Token\Exception\InvalidArgumentException;
use MyTarget\Token\Exception\TokenLimitReachedException;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use MyTarget as f;
use GuzzleHttp\Psr7 as guzzle;

class ClientGrantMiddleware implements HttpMiddleware
{
    /** @var TokenManager  */
    private $tokens;

    /** @var  LockManager */
    private $lockManager;

    /** @var  Cache */
    private $cache;

    /**
     * @param TokenManager $tokens
     * @param LockManager  $lockManager
     * @param Cache        $cache
     */
    public function __construct(TokenManager $tokens, LockManager $lockManager, Cache $cache) {
        $this->tokens = $tokens;
        $this->lockManager = $lockManager;
        $this->cache = $cache;
    }

    /**
     * @inheritdoc
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        $account = isset($context['account']) ? $context['username'] : null;
        $username = isset($context['username']) ? $context['username'] : null;

        if ( ! ($id = $username ?: $account)) {
            throw new InvalidArgumentException('context should contains one of this keys "username" or "account"');
        }

        $this->lockManager->lock($id);

        try {
            if ($username) {
                $token = $this->tokens->getClientToken($request, $username, $context);
            } else {
                $token = $this->tokens->getAccountToken($request, $account, $context);
            }

            $this->lockManager->unlock($id);
        } catch (TokenLimitReachedException $e) {
            throw $e;
        } catch (\Exception $e) {
            $this->lockManager->unlock($id);

            throw $e;
        }

        /** @var RequestInterface $request */
        $request = $request->withHeader('Authorization', sprintf('Bearer %s', $token->getAccessToken()));

        return $stack->request($request, $context);
    }
}
