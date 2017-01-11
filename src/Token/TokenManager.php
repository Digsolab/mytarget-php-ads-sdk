<?php

namespace Dsl\MyTarget\Token;

use Dsl\MyTarget\Context;
use Dsl\MyTarget\Token\ClientCredentials\CredentialsProvider;
use Dsl\MyTarget\Token\Exception\TokenDeletedException;
use Dsl\MyTarget\Token\Exception\TokenLimitReachedException;
use Dsl\MyTarget\Token\Exception\TokenLockException;
use Dsl\MyTarget\Token\Exception\TokenRequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

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
     * @var LoggerInterface
     */
    private $logger;

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
        $this->logger = new NullLogger();
    }

    /**
     * @param callable $cb
     */
    public function setMomentGenerator(callable $cb)
    {
        $this->momentGenerator = $cb;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param RequestInterface $request
     * @param Context $context
     *
     * @return Token|null
     *
     * @throws TokenLockException
     * @throws TokenRequestException
     * @throws TokenLimitReachedException
     * @throws \Exception
     */
    public function getToken(RequestInterface $request, Context $context)
    {
        $id = $this->generateId($request, $context);
        $now = call_user_func($this->momentGenerator);

        $token = $this->storage->getToken($id, $request, $context);
        if ( ! $token || $token->isExpiredAt($now)) {

            if ($token) {
                $this->logger->debug("Token({$id}) was found but is expired, will refresh it");
            } else {
                $this->logger->debug("Token({$id}) was not found, will acquire it");
            }

            if ($this->lockManager) {
                $this->logger->debug("Token({$id}) trying to get a lock");
                try {
                    $this->lockManager->lock($id);
                    $this->logger->debug("Token({$id}) locked");
                } catch (TokenLockException $e) {
                    $this->logger->debug("Token({$id}) couldn't get a lock");
                    throw $e;
                }
            }

            try {
                if ($token) {
                    try {
                        $token = $this->acquirer->refresh($request, $now, $token->getRefreshToken(), $context);
                        $this->storage->updateToken($id, $token, $request, $context);
                        $this->logger->debug("Token({$id}) refreshed the token and put it in the storage");
                    } catch (TokenDeletedException $e) {
                        $this->logger->debug("Token({$id}) was deleted, will try to acquire a new one");

                        // 30 days token expire, we should get new token
                        $token = null;
                    }
                }

                if ( ! $token) {
                    $token = $this->acquirer->acquire($request, $now, $context);
                    $this->storage->updateToken($id, $token, $request, $context);
                    $this->logger->debug("Token({$id}) was acquired and put in the storage");
                }

                if ($this->lockManager) {
                    $this->lockManager->unlock($id);
                    $this->logger->debug("Token({$id}) unlocked");
                }
            } catch (TokenLimitReachedException $e) {
                $this->logger->debug("Token({$id}) limit reached");
                throw $e;
            } catch (\Exception $e) {
                $exClass = get_class($e);
                $this->logger->debug("Token({$id}) exception {$exClass} with message: {$e->getMessage()}");

                // finally works incorrectly with Redis in php5.5
                if ($this->lockManager) {
                    $this->lockManager->unlock($id);
                    $this->logger->debug("Token({$id}) unlocked");
                }

                throw $e;
            }
        }

        return $token;
    }

    /**
     * @param RequestInterface $request
     * @param Context $context
     *
     * @return Token|null
     */
    public function expireToken(RequestInterface $request, Context $context)
    {
        $id = $this->generateId($request, $context);

        $token = $this->storage->getToken($id, $request, $context);
        if (null !== $token) {
            $now = call_user_func($this->momentGenerator);
            $expired = new Token($token->getAccessToken(), $token->getTokenType(), $now, $token->getRefreshToken());

            $this->storage->updateToken($id, $expired, $request, $context);
            $this->logger->debug("Token({$id}) has been forcibly expired");
        } else {
            $this->logger->debug("Token({$id}) not found, can not expire");
        }

        return $token;
    }

    /**
     * @param RequestInterface $request
     * @param Context          $context
     *
     * @return int|null|string
     */
    private function generateId(RequestInterface $request, Context $context)
    {
        $credentials = $this->credentials->getCredentials($request, $context);

        return $context->hasUsername() ? $context->getUsername() : $credentials->getClientId();
    }
}
