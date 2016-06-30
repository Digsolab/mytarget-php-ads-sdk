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

    /**
     * @param Cache $cache
     * @param callable $hashFunction callable(string $id, RequestInterface, $context): string Identity function used as a default
     */
    public function __construct(Cache $cache, callable $hashFunction = null)
    {
        $this->cache = $cache;
        $this->hashFunction = $hashFunction ?: function ($v) { return $v; };
    }

    /**
     * @inheritdoc
     */
    public function getToken(RequestInterface $request, array $context = null)
    {
        return $this->fetch("target_token", $request, $context);
    }

    /**
     * @inheritdoc
     */
    public function updateToken(Token $token, RequestInterface $request, array $context = null)
    {
        $this->save("target_token", $token, $request, $context);
    }

    /**
     * @inheritdoc
     */
    public function getClientToken($username, RequestInterface $request, array $context = null)
    {
        return $this->fetch(sprintf("target_token_%s", $username), $request, $context);
    }

    /**
     * @inheritdoc
     */
    public function updateClientToken($username, Token $token, RequestInterface $request, array $context = null)
    {
        $this->save(sprintf("target_token_%s", $username), $token, $request, $context);
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
        $json = $this->cache->fetch($this->hash($id, $request, $context) . $id);

        if ( ! $json) {
            return null;
        }

        $tokenArray = f\json_decode($json);

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
        $serialized = \json_encode($token->toArray());

        $this->cache->save($this->hash($id, $request, $context), $serialized);
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
