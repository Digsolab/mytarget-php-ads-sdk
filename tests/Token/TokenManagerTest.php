<?php

namespace tests\Dsl\MyTarget\Token;

use Dsl\MyTarget\Token\ClientCredentials\Credentials;
use Dsl\MyTarget\Token\Exception\TokenDeletedException;
use Dsl\MyTarget\Token\Exception\TokenLimitReachedException;
use Dsl\MyTarget\Token\LockManager;
use Dsl\MyTarget\Token\Token;
use Dsl\MyTarget\Token\TokenAcquirer;
use Dsl\MyTarget\Token\TokenManager;
use Dsl\MyTarget\Token\TokenStorage;
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
    /** @var  Token */
    private $responseToken;
    /** @var  Token|\PHPUnit_Framework_MockObject_MockObject */
    private $storageToken;
    /** @var  string */
    private $id;

    public function setUp()
    {
        parent::setUp();
        $this->acquirer = $this->getMock(TokenAcquirer::class, [], [], '', false);
        $this->storage = $this->getMock(TokenStorage::class);
        $this->lockManager = $this->getMock(LockManager::class, [], [], '', false);
        $this->request = $this->getMock(RequestInterface::class);
        $this->manager = new TokenManager($this->acquirer, $this->storage, new Credentials('', ''), $this->lockManager);
        $this->responseToken = new Token('access', 'foo', new \DateTimeImmutable(), 'refresh');
        $this->storageToken = $this->getMock(Token::class, [], [], '', false);
        $this->id = uniqid('login');
    }

    public function testGetStorageToken()
    {
        $now = new \DateTimeImmutable();
        $momentGeneratorCall = false;
        $this->manager->setMomentGenerator(function () use (& $momentGeneratorCall, $now) { $momentGeneratorCall = true; return $now; });

        $this->storageToken->method('getRefreshToken')->willReturn('refresh secret');
        $this->storageToken->method('isExpiredAt')->willReturn(false);
        $this->storageToken->expects($this->once())->method('isExpiredAt')->with($now);

        $this->storage->method('getToken')->willReturn($this->storageToken);

        $this->storage->expects($this->once())->method('getToken')->with($this->id, $this->request, null);

        $token = $this->manager->getClientToken($this->request, $this->id, null);

        $this->assertTrue($momentGeneratorCall);
        $this->assertEquals($this->storageToken, $token);
    }

    public function testGetStorageExpiredToken()
    {
        $now = new \DateTimeImmutable();
        $momentGeneratorCall = false;
        $this->manager->setMomentGenerator(function () use (& $momentGeneratorCall, $now) { $momentGeneratorCall = true; return $now; });

        $this->storageToken->method('getRefreshToken')->willReturn('refresh secret');
        $this->storageToken->method('isExpiredAt')->willReturn(true);
        $this->storageToken->expects($this->once())->method('isExpiredAt')->with($now);

        $this->storage->method('getToken')->willReturn($this->storageToken);

        $this->acquirer->method('refresh')->willReturn($this->responseToken);
        $this->storage->expects($this->once())->method('updateToken')->with($this->id, $this->responseToken, $this->request, null);

        $this->acquirer->expects($this->once())->method('refresh')->with($this->request, $now, 'refresh secret', null);

        $this->storage->expects($this->once())->method('getToken')->with($this->id, $this->request, null);

        $this->lockManager->expects($this->once())->method('lock')->with($this->id);
        $this->lockManager->expects($this->once())->method('unlock')->with($this->id);

        $token = $this->manager->getClientToken($this->request, $this->id, null);

        $this->assertTrue($momentGeneratorCall);
        $this->assertEquals($this->responseToken, $token);
    }

    public function testGetDeletedToken()
    {
        $now = new \DateTimeImmutable();
        $momentGeneratorCall = false;
        $this->manager->setMomentGenerator(function () use (& $momentGeneratorCall, $now) { $momentGeneratorCall = true; return $now; });

        $this->storageToken->method('getRefreshToken')->willReturn('refresh secret');
        $this->storageToken->method('isExpiredAt')->willReturn(true);
        $this->storageToken->expects($this->once())->method('isExpiredAt')->with($now);

        $this->storage->method('getToken')->willReturn($this->storageToken);

        $this->acquirer->method('refresh')->willThrowException(new TokenDeletedException('', $this->request));
        $this->acquirer->expects($this->once())->method('refresh')->with($this->request, $now, 'refresh secret', null);

        $this->acquirer->method('acquire')->willReturn($this->responseToken);
        $this->storage->expects($this->once())->method('updateToken')->with($this->id, $this->responseToken, $this->request, null);

        $this->acquirer->expects($this->once())->method('acquire')->with($this->request, $now, $this->id, null);

        $this->storage->expects($this->once())->method('getToken')->with($this->id, $this->request, null);

        $this->lockManager->expects($this->once())->method('lock')->with($this->id);
        $this->lockManager->expects($this->once())->method('unlock')->with($this->id);
        $token = $this->manager->getClientToken($this->request, $this->id, null);

        $this->assertTrue($momentGeneratorCall);
        $this->assertEquals($this->responseToken, $token);
    }

    public function testGetEmptyToken()
    {
        $now = new \DateTimeImmutable();
        $momentGeneratorCall = false;
        $this->manager->setMomentGenerator(function () use (& $momentGeneratorCall, $now) { $momentGeneratorCall = true; return $now; });

        $this->acquirer->method('acquire')->willReturn($this->responseToken);
        $this->storage->expects($this->once())->method('updateToken')->with($this->id, $this->responseToken, $this->request, null);

        $this->acquirer->expects($this->once())->method('acquire')->with($this->request, $now, $this->id, null);

        $this->storage->expects($this->once())->method('getToken')->with($this->id, $this->request, null);

        $this->lockManager->expects($this->once())->method('lock')->with($this->id);
        $this->lockManager->expects($this->once())->method('unlock')->with($this->id);

        $token = $this->manager->getClientToken($this->request, $this->id, null);

        $this->assertTrue($momentGeneratorCall);
        $this->assertTrue($token instanceof Token);
    }

    /**
     * @return array
     */
    public function getTokenFailedDataProvider()
    {
        return [
            [true],
            [false],
        ];
    }

    /**
     * @param bool $exist
     *
     * @dataProvider getTokenFailedDataProvider
     */
    public function testGetTokenFailed($exist)
    {
        $this->setExpectedException(TokenLimitReachedException::class);

        if ($exist) {
            $this->storageToken->method('isExpiredAt')->willReturn(true);
            $this->storage->method('getToken')->willReturn($this->storageToken);
            $this->acquirer->method('refresh')->willThrowException(new TokenLimitReachedException('', $this->request));
        } else {
            $this->acquirer->method('acquire')->willThrowException(new TokenLimitReachedException('', $this->request));
        }

        $this->manager->getClientToken($this->request, $this->id, null);
    }

}
