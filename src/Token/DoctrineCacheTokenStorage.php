<?php

namespace Dsl\MyTarget\Token;

use Doctrine\Common\Cache\Cache;
use Psr\Http\Message\RequestInterface;
use Dsl\MyTarget as f;
use Dsl\MyTarget\Context;

/**
 * Token storage implementation that depends on "doctrine/cache" composer package
 */
class DoctrineCacheTokenStorage implements TokenStorage
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var callable(string $id, RequestInterface, $context): string
     */
    private $hashFunction;

    /**
     * @param Cache $cache
     * @param callable $hashFunction callable(string $id, RequestInterface, Context $context): string Identity function used as a default
     */
    public function __construct(Cache $cache, callable $hashFunction = null)
    {
        $this->cache = $cache;
        $this->hashFunction = $hashFunction ?: function ($v) { return $v; };
    }

    /**
     * @inheritdoc
     */
    public function getToken($id, RequestInterface $request, Context $context)
    {
        $id = call_user_func($this->hashFunction, $id, $request, $context);
        $tokenArray = $this->cache->fetch($id);

        if ( ! $tokenArray) {
            return null;
        }

        return Token::fromArray($tokenArray);
    }

    /**
     * @inheritdoc
     */
    public function updateToken($id, Token $token, RequestInterface $request, Context $context)
    {
        $id = call_user_func($this->hashFunction, $id, $request, $context);

        $this->cache->save($id, $token->toArray());
    }
}
