<?php

namespace MyTarget\Token;

use Doctrine\Common\Cache\Cache;
use Psr\Http\Message\RequestInterface;
use MyTarget as f;

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

    /** @var  string */
    private $keyPrefix;

    /**
     * @param Cache $cache
     * @param callable $hashFunction callable(string $id, RequestInterface, $context): string Identity function used as a default
     * @param string $keyPrefix
     */
    public function __construct(Cache $cache, callable $hashFunction = null, $keyPrefix)
    {
        $this->cache = $cache;
        $this->hashFunction = $hashFunction ?: function ($v) { return $v; };

        $this->keyPrefix = $keyPrefix;
    }

    /**
     * @inheritdoc
     */
    public function getToken($id, RequestInterface $request, array $context = null)
    {
        return $this->fetch(sprintf("%s_%s", $this->keyPrefix, $id), $request, $context);
    }

    /**
     * @inheritdoc
     */
    public function updateToken($id, Token $token, RequestInterface $request, array $context = null)
    {
        $this->save(sprintf("%s_%s", $this->keyPrefix, $id), $token, $request, $context);
    }

    /**
     * @param string $id
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return Token|null
     */
    protected function fetch($id, RequestInterface $request, array $context = null)
    {
        $tokenArray = $this->cache->fetch($this->hash($id, $request, $context) . $id);

        if ( ! $tokenArray) {
            return null;
        }

        return Token::fromArray($tokenArray);
    }

    /**
     * @param string $id
     * @param Token $token
     * @param RequestInterface $request
     * @param array|null $context
     */
    protected function save($id, Token $token, RequestInterface $request, array $context = null)
    {
        $this->cache->save($this->hash($id, $request, $context), $token->toArray());
    }

    /**
     * @param string $id
     * @param RequestInterface $request
     * @param array|null $context
     * @return string
     */
    protected function hash($id, RequestInterface $request, array $context = null)
    {
        $f = $this->hashFunction;

        return $f($id, $request, $context);
    }
}
