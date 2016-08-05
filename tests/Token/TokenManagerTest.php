<?php

namespace MyTarget\Token;

use MyTarget\Token\Exception\TokenDeletedException;
use MyTarget\Token\Exception\TokenLimitReachedException;
use Psr\Http\Message\RequestInterface;

class TokenManagerTest extends  \PHPUnit_Framework_TestCase
{
    /** @var  TokenAcquirer|\PHPUnit_Framework_MockObject_MockObject */
    private $acquirer;
    /** @var  TokenStorage|\PHPUnit_Framework_MockObject_MockObject */
    private $storage;
    /** @var  LockManager|\PHPUnit_Framework_MockObject_MockObject */
    private $lockManager;

    /** @var  RequestInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $request;

    /** @var  TokenManager */
    private $manager;

    public function setUp()
    {
        parent::setUp();

        $this->acquirer = $this->getMock(TokenAcquirer::class, [], [], '', false);
        $this->storage = $this->getMock(TokenStorage::class);
        $this->lockManager = $this->getMock(LockManager::class, [], [], '', false);

        $this->request = $this->getMock(RequestInterface::class);

        $this->manager = new TokenManager($this->acquirer, $this->storage, $this->lockManager);
    }

    /**
     * @return array
     */
    public function getTokenDataProvider()
    {
        return [
            ['CLIENT-1.1', null, null, null, null, false],
            ['CLIENT-1.2', null, null, null, TokenLimitReachedException::class, false],

            ['CLIENT-2.1', null, [], false, null, false],
            ['CLIENT-2.2', null, ['foo' => 'bar'], true, null, false],

            ['CLIENT-3.1', null, ['bar' => 'foo'], true, null, true],
            ['CLIENT-3.2', null, [], true, TokenLimitReachedException::class, true],

            [null, 'USER-1.1', null, null, null, false],
            [null, 'USER-1.2', null, null, TokenLimitReachedException::class, false],

            [null, 'USER-2.1', [], false, null, false],
            [null, 'USER-2.2', ['foo' => 'bar'], true, null, false],

            [null, 'USER-3.1', ['bar' => 'foo'], true, null, true],
            [null, 'USER-3.2', [], true, TokenLimitReachedException::class, true],
        ];
    }

    /**
     * @param string|null $client
     * @param string|null $username
     * @param array|null  $context
     * @param bool|null   $isExpiredAt
     * @param string|null $exception
     * @param bool        $isDeleted
     *
     * @dataProvider getTokenDataProvider
     */
    public function testGetToken($client, $username, $context, $isExpiredAt, $exception, $isDeleted)
    {
        $id = $username ?: $client;

        $momentGeneratorCall = false;
        $now = new \DateTime();
        $this->manager->setMomentGenerator(function () use (& $momentGeneratorCall, $now) { $momentGeneratorCall = true; return $now; });

        if ($exception) {
            $this->setExpectedException($exception);
        }

        $responseTokenMock = $this->getMock(Token::class, [], [], '', false);

        // Token in storage
        if (is_bool($isExpiredAt)) {
            $storageTokenMock = $this->getMock(Token::class, [], [], '', false);
            $storageTokenMock->method('getRefreshToken')->willReturn('refresh secret');
            $storageTokenMock->method('isExpiredAt')->willReturn($isExpiredAt);
            $storageTokenMock->expects($this->once())->method('isExpiredAt')->with($now);

            $this->storage->method('getToken')->willReturn($storageTokenMock);

            if ($isExpiredAt) {
                if ($isDeleted) {
                    $this->acquirer->method('refresh')->willThrowException(new TokenDeletedException('', $this->request));
                } else {
                    $this->acquirer->method('refresh')->willReturn($responseTokenMock);
                    $this->storage->expects($this->once())->method('updateToken')->with($id, $responseTokenMock, $this->request, $context);
                }

                $this->acquirer->expects($this->once())->method('refresh')->with($this->request, $now, 'refresh secret', $context);
            }
        }

        // Empty storage or Token was deleted by Target
        if (is_null($isExpiredAt) || $isDeleted) {
            if ($exception) {
                $this->acquirer->method('acquire')->willThrowException(new TokenLimitReachedException('', $this->request));
            } else {
                $this->acquirer->method('acquire')->willReturn($responseTokenMock);
                $this->storage->expects($this->once())->method('updateToken')->with($id, $responseTokenMock, $this->request, $context);
            }

            $this->acquirer->expects($this->once())->method('acquire')->with($this->request, $now, $username, $context);
        }

        $this->storage->expects($this->once())->method('getToken')->with($id, $this->request, $context);

        // Empty storage or Token expired
        if (is_null($isExpiredAt) || $isExpiredAt) {
            $this->lockManager->expects($this->once())->method('lock')->with($id);
            if (TokenLimitReachedException::class !== $exception) {
                $this->lockManager->expects($this->once())->method('unlock')->with($id);
            }
        }

        if ($username) {
            $token = $this->manager->getUserToken($this->request, $username, $context);
        } else {
            $token = $this->manager->getClientToken($this->request, $client, $context);
        }

        $this->assertTrue($momentGeneratorCall);
        $this->assertTrue($token instanceof Token);
    }

}
