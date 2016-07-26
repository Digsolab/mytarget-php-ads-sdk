<?php

namespace MyTarget\Token;

use Doctrine\Common\Cache\Cache;
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
     *
     * @throws TokenLockException
     * @throws TokenLimitReachedException
     * @throws TokenRequestException
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        $client = $username = null;

        if (empty($context['username'])) {
            $id = $client = $this->tokens->getAcquirer()->getCredentials()->getCredentials($request, $context)->getClientId();
        } else {
            $id = $username = $context['username'];
        }

        $this->lockManager->lock($id);

        try {
            if ($username) {
                $token = $this->tokens->getUserToken($request, $username, $context);
            } else {
                $token = $this->tokens->getClientToken($request, $client, $context);
            }

            $this->lockManager->unlock($id);
        } catch (TokenLimitReachedException $e) {
            throw $e;
        } catch (\Exception $e) {
            // @todo finally works incorrect with Redis in php5.5
            $this->lockManager->unlock($id);

            throw $e;
        }

        /** @var RequestInterface $request */
        $request = $request->withHeader('Authorization', sprintf('Bearer %s', $token->getAccessToken()));

        return $stack->request($request, $context);
    }
}
