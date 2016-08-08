<?php

namespace MyTarget\Token;

use MyTarget\Token\Exception\TokenDeletedException;
use MyTarget\Token\Exception\TokenLimitReachedException;
use MyTarget\Token\Exception\TokenLockException;
use MyTarget\Token\Exception\TokenRequestException;
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

    /** @var  LockManager */
    private $lockManager;

    /**
     * @var callable callable(): \DateTime Returns current moment
     */
    private $momentGenerator;

    public function __construct(TokenAcquirer $acquirer, TokenStorage $storage, LockManager $lockManager)
    {
        $this->acquirer = $acquirer;
        $this->storage = $storage;
        $this->lockManager = $lockManager;
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
     * @param string           $client
     * @param array|null       $context
     *
     * @return Token|null
     *
     * @throws TokenLockException
     * @throws TokenRequestException
     * @throws TokenLimitReachedException
     * @throws \Exception
     */
    public function getClientToken(RequestInterface $request, $client, array $context = null)
    {
        return $this->getToken($request, $client, null, $context);
    }

    /**
     * @param RequestInterface $request
     * @param string $username
     * @param array|null $context
     *
     * @return Token|null
     *
     * @throws TokenLockException
     * @throws TokenRequestException
     * @throws TokenLimitReachedException
     * @throws \Exception
     */
    public function getUserToken(RequestInterface $request, $username, array $context = null)
    {
        return $this->getToken($request, null, $username, $context);
    }

    /**
     * @param RequestInterface $request
     * @param string|null      $account
     * @param string|null      $username
     * @param array|null       $context
     *
     * @return Token|null
     *
     * @throws TokenLockException
     * @throws TokenRequestException
     * @throws TokenLimitReachedException
     * @throws \Exception
     */
    private function getToken(RequestInterface $request, $account = null, $username = null, array $context = null)
    {
        $id = $username ?: $account;

        $now = call_user_func($this->momentGenerator);
        $token = $this->storage->getToken($id, $request, $context);

        if ( ! $token || $token->isExpiredAt($now)) {

            $this->lockManager->lock($id);

            try {
                if ($token) {
                    try {
                        $token = $this->acquirer->refresh($request, $now, $token->getRefreshToken(), $context);
                        $this->storage->updateToken($id, $token, $request, $context);
                    } catch (TokenDeletedException $e) {
                        // 30 days token expire, we should get new token
                        $token = null;
                    }
                }

                if ( ! $token) {
                    $token = $this->acquirer->acquire($request, $now, $username, $context);
                    $this->storage->updateToken($id, $token, $request, $context);
                }

                $this->lockManager->unlock($id);

            } catch (TokenLimitReachedException $e) {
                throw $e;
            } catch (\Exception $e) {
                // @todo finally works incorrect with Redis in php5.5
                $this->lockManager->unlock($id);

                throw $e;
            }
        }

        return $token;
    }

    /**
     * @return TokenAcquirer
     */
    public function getAcquirer()
    {
        return $this->acquirer;
    }

    /**
     * @return LockManager
     */
    public function getLockManager()
    {
        return $this->lockManager;
    }

    /**
     * @param Token            $token
     * @param RequestInterface $request
     * @param string|null      $account
     * @param string|null      $username
     * @param array|null       $context
     */
    public function expireToken(Token $token, RequestInterface $request, $account = null, $username = null, array $context = null)
    {
        $token->invalidate();
        $id = $username ?: $account;
        $this->storage->updateToken($id, $token, $request, $context);
    }
}
