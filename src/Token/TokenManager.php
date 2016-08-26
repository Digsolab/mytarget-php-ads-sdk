<?php

namespace Dsl\MyTarget\Token;

use Dsl\MyTarget\Token\ClientCredentials\CredentialsProvider;
use Dsl\MyTarget\Token\Exception\TokenDeletedException;
use Dsl\MyTarget\Token\Exception\TokenLimitReachedException;
use Dsl\MyTarget\Token\Exception\TokenLockException;
use Dsl\MyTarget\Token\Exception\TokenRequestException;
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
     * @var CredentialsProvider
     */
    private $credentials;

    /**
     * @var LockManager
     */
    private $lockManager;

    /**
     * @var callable callable(): \DateTimeInterface Returns current moment
     */
    private $momentGenerator;

    /**
     * @param TokenAcquirer $acquirer
     * @param TokenStorage $storage
     * @param CredentialsProvider $credentials
     * @param LockManager|null $lockManager Lock manager is optional, locking will be used if it is provided
     */
    public function __construct(TokenAcquirer $acquirer, TokenStorage $storage, CredentialsProvider $credentials, LockManager $lockManager = null)
    {
        $this->acquirer = $acquirer;
        $this->storage = $storage;
        $this->credentials = $credentials;
        $this->lockManager = $lockManager;
        $this->momentGenerator = function () {
            return new \DateTimeImmutable();
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
     * @param string           $username
     * @param array|null       $context
     *
     * @return Token|null
     *
     * @throws TokenLockException
     * @throws TokenRequestException
     * @throws TokenLimitReachedException
     */
    public function getClientToken(RequestInterface $request, $username, array $context = null)
    {
        return $this->doGetToken($request, $username, $context);
    }

    /**
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return Token|null
     *
     * @throws TokenLockException
     * @throws TokenRequestException
     * @throws TokenLimitReachedException
     */
    public function getToken(RequestInterface $request, array $context = null)
    {
        return $this->doGetToken($request, null, $context);
    }

    /**
     * @param RequestInterface $request
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
    private function doGetToken(RequestInterface $request, $username = null, array $context = null)
    {
        $credentials = $this->credentials->getCredentials($request, $context);
        $id = $username ?: $credentials->getClientId();

        $now = call_user_func($this->momentGenerator);
        $token = $this->storage->getToken($id, $request, $context);

        if ( ! $token || $token->isExpiredAt($now)) {

            if ($this->lockManager) {
                $this->lockManager->lock($id);
            }

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

                if ($this->lockManager) {
                    $this->lockManager->unlock($id);
                }
            } catch (TokenLimitReachedException $e) {
                throw $e;
            } catch (\Exception $e) {
                // finally works incorrectly with Redis in php5.5
                if ($this->lockManager) {
                    $this->lockManager->unlock($id);
                }

                throw $e;
            }
        }

        return $token;
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
        $moment = call_user_func($this->momentGenerator);

        $expired = new Token($token->getAccessToken(), $token->getTokenType(), $moment, $token->getRefreshToken());
        $id = $username ?: $account;
        $this->storage->updateToken($id, $expired, $request, $context);
    }
}
