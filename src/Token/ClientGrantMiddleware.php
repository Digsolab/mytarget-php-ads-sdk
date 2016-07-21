<?php

namespace MyTarget\Token;

use Doctrine\Common\Cache\Cache;
use DSL\LockInterface;
use MyTarget\Token\Exception\InvalidArgumentException;
use MyTarget\Token\Exception\TokenRequestException;
use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use MyTarget as f;
use GuzzleHttp\Psr7 as guzzle;

class ClientGrantMiddleware implements HttpMiddleware
{
    const TEMPORARY_LOCK_TIME = 300;
    const PERMANENT_LOCK_TIME = 3600;
    const LOCK_PREFIX = 'lock_';

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
    private $temporaryLockTime;

    /** @var  int */
    private $permanentLockTime;

    public function __construct(
        TokenManager  $tokens,
        LockInterface $lock,
        Cache         $cache,
        $lockPrefix = self::LOCK_PREFIX,
        $temporaryLockTime = self::TEMPORARY_LOCK_TIME,
        $permanentLockTime = self::PERMANENT_LOCK_TIME
    ) {
        $this->tokens = $tokens;
        $this->lock = $lock;
        $this->cache = $cache;

        $this->lockPrefix = $lockPrefix;
        $this->temporaryLockTime = $temporaryLockTime;
        $this->permanentLockTime = $permanentLockTime;
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

        $temporaryLockName = sprintf("%starget_token_%s_temporary", $this->lockPrefix, $username ?: $account);
        $permanentLockName = sprintf("%starget_token_%s_permanent", $this->lockPrefix, $username ?: $account);

        if ( ! $this->lock->lock($temporaryLockName, $this->temporaryLockTime)) {
            TokenRequestException::temporaryLockFailed($temporaryLockName, $request);
        }

        try {
            if ( ! $this->lock->lock($permanentLockName, $this->permanentLockTime)) {
                TokenRequestException::permanentLockFailed($permanentLockName, $request);
            }

            if ($username) {
                $token = $this->tokens->getClientToken($request, $username, $context);
            } else {
                $token = $this->tokens->getAccountToken($request, $account, $context);
            }

            $this->lock->unlock($temporaryLockName);
            $this->lock->unlock($permanentLockName);

        } catch (TokenRequestException $e) {
            $this->lock->unlock($temporaryLockName);
            if ($e->response && 200 == $e->response->getStatusCode()) {
                $this->lock->unlock($temporaryLockName);
            }

            throw $e;
        } catch (\Exception $e) {
            // @todo finally works incorrect with Redis in php5.5
            $this->lock->unlock($temporaryLockName);

            throw $e;
        }

        $request = $request->withHeader("Authorization", sprintf("Bearer %s", $token->getAccessToken()));
        /** @var RequestInterface $request */

        return $stack->request($request, $context);
    }
}
