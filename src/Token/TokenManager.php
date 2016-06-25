<?php

namespace MyTarget\Token;

use Psr\Http\Message\RequestInterface;

class TokenManager
{
    /**
     * @var TokenAcquirer
     */
    private $acquirer;

    /**
     * @var TokenStorage
     */
    private $storage;

    /**
     * @var callable callable(): \DateTime Returns current moment
     */
    private $momentGenerator;

    public function __construct(TokenAcquirer $acquirer, TokenStorage $storage)
    {
        $this->acquirer = $acquirer;
        $this->storage = $storage;
        $this->momentGenerator = function () {
            return new \DateTime();
        };
    }

    /**
     * @param callable $cb
     */
    public function setMomentGenerator(callable $cb)
    {
        $this->momentGenerator = $cb;
    }

    /**
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return Token|null
     */
    public function getToken(RequestInterface $request, array $context = null)
    {
        $now = call_user_func($this->momentGenerator);
        $token = $this->storage->getToken($request, $context);

        if ($token === null) {
            $token = $this->acquirer->acquire($request, $now, null, $context);
            $this->storage->updateToken($token, $request, $context);
        }
        elseif ($token->isExpiredAt($now)) {
            $token = $this->acquirer->refresh($request, $now, $token->getRefreshToken(), $context);
            $this->storage->updateToken($token, $request, $context);
        }

        return $token;
    }

    /**
     * @param RequestInterface $request
     * @param string $username
     * @param array|null $context
     *
     * @return Token|null
     */
    public function getClientToken(RequestInterface $request, $username, array $context = null)
    {
        $now = call_user_func($this->momentGenerator);
        $token = $this->storage->getClientToken($username, $request, $context);

        if ($token === null) {
            $token = $this->acquirer->acquire($request, $now, $username, $context);
            $this->storage->updateClientToken($username, $token, $request, $context);
        }
        elseif ($token->isExpiredAt($now)) {
            $token = $this->acquirer->refresh($request, $now, $token->getRefreshToken(), $context);
            $this->storage->updateClientToken($username, $token, $request, $context);
        }

        return $token;
    }
}
