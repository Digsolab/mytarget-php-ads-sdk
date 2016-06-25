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
     * @var callable(RequestInterface, $context): string
     */
    private $hashFunction;

    /**
     * @param Cache $cache
     * @param callable $hashFunction callable(RequestInterface, $context): string
     */
    public function __construct(Cache $cache, callable $hashFunction)
    {
        $this->cache = $cache;
        $this->hashFunction = $hashFunction;
    }

    /**
     * @inheritdoc
     */
    public function getToken(RequestInterface $request, array $context = null)
    {
        return $this->fetch("_token", $request, $context);
    }

    /**
     * @inheritdoc
     */
    public function updateToken(Token $token, RequestInterface $request, array $context = null)
    {
        $this->save("_token", $token, $request, $context);
    }

    /**
     * @inheritdoc
     */
    public function getClientToken($username, RequestInterface $request, array $context = null)
    {
        return $this->fetch(sprintf("_token_%s", $username), $request, $context);
    }

    /**
     * @inheritdoc
     */
    public function updateClientToken($username, Token $token, RequestInterface $request, array $context = null)
    {
        $this->save(sprintf("_token_%s", $username), $token, $request, $context);
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
        $json = $this->cache->fetch($this->hash($request, $context) . $id);

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

        $this->cache->save($this->hash($request, $context) . $id, $serialized);
    }

    /**
     * @param RequestInterface $request
     * @param array|null $context
     * @return string
     */
    protected function hash(RequestInterface $request, array $context = null)
    {
        $f = $this->hashFunction;

        return $f($request, $context);
    }
}
