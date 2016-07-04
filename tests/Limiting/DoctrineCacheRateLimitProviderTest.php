<?php

namespace MyTarget\Limiting;

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

        $username = '12345@agency_client';
        $context = ['limit-by' => 'campaigns-all'];
        $id = 'campaigns-all#12345@agency_client';
        $limits = [
            'X-RateLimit-RPS-Limit' => 10,
            'X-RateLimit-RPS-Remaining' => 0
        ];

        $this->idBuilder->expects($this->once())
            ->method('buildId')
            ->with($context['limit-by'], $username)
            ->willReturn($id);

        $this->cache->expects($this->once())
            ->method('fetch')
            ->with($id)
            ->willReturn($limits);

        $result = $limitProvider->isLimitReached($context['limit-by'], $username);

        $this->assertEquals($result, true);
    }

    public function testItDoesNotPanicWhenNoLimitsCached()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->idBuilder, $this->limitExtractor);

        $username = '12345@agency_client';
        $context = ['limit-by' => 'campaigns-all'];
        $id = 'campaigns-all#12345@agency_client';
        $limits = false;

        $this->idBuilder->expects($this->once())
                        ->method('buildId')
                        ->with($context['limit-by'], $username)
                        ->willReturn($id);

        $this->cache->expects($this->once())
                    ->method('fetch')
                    ->with($id)
                    ->willReturn($limits);

        $result = $limitProvider->isLimitReached($context['limit-by'], $username);

        $this->assertEquals($result, false);
    }

    public function testItDoesNotPanicWhenNoLimitReached()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->idBuilder, $this->limitExtractor);

        $username = '12345@agency_client';
        $context = ['limit-by' => 'campaigns-all'];
        $id = 'campaigns-all#12345@agency_client';
        $limits = [
            'X-RateLimit-RPS-Limit' => 10,
            'X-RateLimit-RPS-Remaining' => 20
        ];

        $this->idBuilder->expects($this->once())
                        ->method('buildId')
                        ->with($context['limit-by'], $username)
                        ->willReturn($id);

        $this->cache->expects($this->once())
                    ->method('fetch')
                    ->with($id)
                    ->willReturn($limits);

        $result = $limitProvider->isLimitReached($context['limit-by'], $username);

        $this->assertEquals($result, false);
    }

    public function testItUpdatesLimits()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->idBuilder, $this->limitExtractor);

        $response = $this->getMock(ResponseInterface::class);
        $username = '12345@agency_client';
        $context = ['limit-by' => 'campaigns-all'];
        $id = 'campaigns-all#12345@agency_client';
        $limits = [
            'X-RateLimit-RPS-Limit' => 10,
            'X-RateLimit-RPS-Remaining' => 20
        ];

        $this->idBuilder->expects($this->once())
                        ->method('buildId')
                        ->with($context['limit-by'], $username)
                        ->willReturn($id);

        $this->limitExtractor->expects($this->once())
                        ->method('extractLimits')
                        ->with($response)
                        ->willReturn($limits);

        $this->cache->expects($this->once())
                    ->method('save')
                    ->with($id, $limits);

        $limitProvider->refreshLimits($response, $context['limit-by'], $username);
    }
}
