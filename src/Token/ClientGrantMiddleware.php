<?php

namespace MyTarget\Token;

use Doctrine\Common\Cache\Cache;
use DSL\LockInterface;
use MyTarget\Token\Exception\InvalidArgumentException;
use MyTarget\Token\Exception\TokenLimitReachedException;
use MyTarget\Token\Exception\TokenLockException;
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

    /** @var  LockInterface */
    private $lock;

    /** @var  Cache */
    private $cache;

    /** @var  string */
    private $lockPrefix;

    /** @var  int */
    private $lockLifetime;

    public function __construct(
        TokenManager  $tokens,
        LockInterface $lock,
        Cache         $cache,
        $lockPrefix,
        $lockLifetime
    ) {
        $this->tokens = $tokens;
        $this->lock = $lock;
        $this->cache = $cache;

        $this->lockPrefix = $lockPrefix;
        $this->lockLifetime = $lockLifetime;
    }

    /**
     * @inheritdoc
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        $account = isset($context["account"]) ? $context["account"] : null;
        $username = isset($context["username"]) ? $context["username"] : null;

        if ( ! $account &&  ! $username) {
            throw new InvalidArgumentException('context should contains one of this keys "username" or "account"');
        }

        $lockName = sprintf("%s_%s", $this->lockPrefix, $username ?: $account);

        if ( ! $this->lock->lock($lockName, $this->lockLifetime)) {
            throw new TokenLockException(sprintf('Could not obtain temporary cache lock: %s', $lockName));
        }

        try {
            if ($username) {
                $token = $this->tokens->getClientToken($request, $username, $context);
            } else {
                $token = $this->tokens->getAccountToken($request, $account, $context);
            }

            $this->lock->unlock($lockName);
        } catch (TokenLimitReachedException $e) {
            throw $e;
        } catch (\Exception $e) {
            $this->lock->unlock($lockName);

            throw $e;
        }

        $request = $request->withHeader("Authorization", sprintf("Bearer %s", $token->getAccessToken()));

        /** @var RequestInterface $request */

        return $stack->request($request, $context);
    }
}
