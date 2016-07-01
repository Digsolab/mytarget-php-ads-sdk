<?php

namespace MyTarget\Limiting;

use MyTarget\Limiting\Exception\ThrottleException;
use MyTarget\Limiting\IdBuilder;
use MyTarget\Limiting\LimitExtractor;
use Doctrine\Common\Cache\Cache;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DoctrineCacheRateLimitProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $cache;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $idBuilder;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $limitExtractor;

    protected function setUp()
    {
        $this->cache = $this->getMock(Cache::class);
        $this->idBuilder = $this->getMock(IdBuilder::class);
        $this->limitExtractor = $this->getMock(LimitExtractor::class);
    }

    public function testItPanicsWhenLimitReached()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->idBuilder, $this->limitExtractor);

        $request = $this->getMock(RequestInterface::class);
        $username = '12345@agency_client';
        $id = '12345@agency_client#GET:/api/v1/PARAM.json';
        $limits = [
            'X-RateLimit-RPS-Limit' => 10,
            'X-RateLimit-RPS-Remaining' => 0
        ];

        $this->idBuilder->expects($this->once())
            ->method('buildId')
            ->with($request, $username)
            ->willReturn($id);

        $this->cache->expects($this->once())
            ->method('fetch')
            ->with($id)
            ->willReturn($limits);

        $result = $limitProvider->isLimitReached($request, $username);

        $this->assertEquals($result, true);
    }

    public function testItDoesNotPanicWhenNoLimitsCached()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->idBuilder, $this->limitExtractor);

        $request = $this->getMock(RequestInterface::class);
        $username = '12345@agency_client';
        $id = '12345@agency_client#GET:/api/v1/PARAM.json';
        $limits = false;

        $this->idBuilder->expects($this->once())
                        ->method('buildId')
                        ->with($request, $username)
                        ->willReturn($id);

        $this->cache->expects($this->once())
                    ->method('fetch')
                    ->with($id)
                    ->willReturn($limits);

        $result = $limitProvider->isLimitReached($request, $username);

        $this->assertEquals($result, false);
    }

    public function testItDoesNotPanicWhenNoLimitReached()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->idBuilder, $this->limitExtractor);

        $request = $this->getMock(RequestInterface::class);
        $username = '12345@agency_client';
        $id = '12345@agency_client#GET:/api/v1/PARAM.json';
        $limits = [
            'X-RateLimit-RPS-Limit' => 10,
            'X-RateLimit-RPS-Remaining' => 20
        ];

        $this->idBuilder->expects($this->once())
                        ->method('buildId')
                        ->with($request, $username)
                        ->willReturn($id);

        $this->cache->expects($this->once())
                    ->method('fetch')
                    ->with($id)
                    ->willReturn($limits);

        $result = $limitProvider->isLimitReached($request, $username);

        $this->assertEquals($result, false);
    }

    public function testItUpdatesLimits()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->idBuilder, $this->limitExtractor);

        $request = $this->getMock(RequestInterface::class);
        $response = $this->getMock(ResponseInterface::class);
        $username = '12345@agency_client';
        $id = '12345@agency_client#GET:/api/v1/PARAM.json';
        $limits = [
            'X-RateLimit-RPS-Limit' => 10,
            'X-RateLimit-RPS-Remaining' => 20
        ];

        $this->idBuilder->expects($this->once())
                        ->method('buildId')
                        ->with($request, $username)
                        ->willReturn($id);

        $this->limitExtractor->expects($this->once())
                        ->method('extractLimits')
                        ->with($response)
                        ->willReturn($limits);

        $this->cache->expects($this->once())
                    ->method('save')
                    ->with($id, $limits);

        $limitProvider->refreshLimits($request, $response, $username);
    }
}
