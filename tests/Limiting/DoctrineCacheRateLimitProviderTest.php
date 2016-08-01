<?php

namespace tests\MyTarget\Limiting;

use MyTarget\Limiting\DoctrineCacheRateLimitProvider;
use MyTarget\Limiting\LimitExtractor;
use Doctrine\Common\Cache\Cache;
use MyTarget\Limiting\Limits;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DoctrineCacheRateLimitProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|Cache */
    protected $cache;
    /** @var \PHPUnit_Framework_MockObject_MockObject|LimitExtractor */
    protected $limitExtractor;
    /** @var  \PHPUnit_Framework_MockObject_MockObject|RequestInterface */
    protected $request;

    protected function setUp()
    {
        $this->cache = $this->getMock(Cache::class);
        $this->limitExtractor = $this->getMock(LimitExtractor::class);
        $this->request = $this->getMockForAbstractClass(RequestInterface::class, [], "", false);
    }

    public function limits()
    {
        $moment = new \DateTimeImmutable("00:00:00 01/01/2016");
        $moment2 = new \DateTimeImmutable("12:00:00 01/01/2016");

        return [
            // 1. Limit ----------------------------------- 2. moment at which this limit should be tested
            // ---------------------------------------------------- 3. should it fail or not in the end

            [Limits::create($moment, 0, null, null, null), $moment, true], // should fail
            [Limits::create($moment, 0, null, null, null), $moment->add(new \DateInterval("PT1S")), false], // should not fail nor falter I shall succeed. my perception is altered I do believe
            [Limits::create($moment, 1, 1, 1, 1), $moment, false],
            [Limits::create($moment, 1, 0, null, null), $moment->add(new \DateInterval("PT59S")), true],
            [Limits::create($moment, 1, 0, null, null), $moment->add(new \DateInterval("PT1M")), false],
            [Limits::create($moment, 0, 0, 1, 1), $moment->add(new \DateInterval("PT1M")), false],
            [Limits::create($moment, 1, 1, 0, 1), $moment->add(new \DateInterval("PT59M")), true],
            [Limits::create($moment, 1, 1, 0, 1), $moment->add(new \DateInterval("PT1H")), false],
            [Limits::create($moment, 1, 1, 1, 0), $moment, true],
            [Limits::create($moment, 1, 1, 1, 0), $moment->add(new \DateInterval("PT23H59M59S")), true],
            [Limits::create($moment2, 1, 1, 1, 0), $moment2->add(new \DateInterval("PT23H59M59S")), false],
            [Limits::create($moment, 1, 1, 1, 0), $moment->add(new \DateInterval("P1D")), false],
            [Limits::create($moment, 0, 0, 0, 0), $moment->sub(new \DateInterval("PT1S")), false] // we went back in time there clearly are no limits for us
        ];
    }

    /**
     * @dataProvider limits
     */
    public function testLimits(Limits $limits, \DateTimeImmutable $moment, $shouldFail)
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->limitExtractor);
        $limitProvider->setMomentGenerator(function () use ($moment) {
            return $moment;
        });

        $username = "bar";
        $limitBy = "campaigns-all";

        $this->cache->expects($this->once())
            ->method("fetch")
            ->with("{$limitBy}#{$username}")
            ->willReturn($limits->toArray());

        $result = $limitProvider->isLimitReached($limitBy, $this->request, ["username" => $username]);

        if ($shouldFail) {
            $this->assertTrue($result, "This check should have failed (the limit is reached)");
        } else {
            $this->assertFalse($result, "This check should have succeeded (the limit is not reached)");
        }
    }

    public function testItDoesNotPanicWhenNoLimitsCached()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->limitExtractor);

        $username = "bar";
        $limitBy = "campaigns-all";
        $limits = false;

        $this->cache->expects($this->once())
                    ->method("fetch")
                    ->with("{$limitBy}#{$username}")
                    ->willReturn($limits);

        $result = $limitProvider->isLimitReached($limitBy, $this->request, ["username" => $username]);

        $this->assertFalse($result);
    }

    public function testItUpdatesLimits()
    {
        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->limitExtractor);

        $response = $this->getMockForAbstractClass(ResponseInterface::class, [], "", false);
        $username = "12345@agency_client";
        $limitBy = "campaigns-all";
        $id = "campaigns-all#12345@agency_client";
        $limits = Limits::create(new \DateTime(), 1, 1, 1, 1);

        $this->limitExtractor->expects($this->once())
                        ->method("extractLimits")
                        ->with($response)
                        ->willReturn($limits);

        $this->cache->expects($this->once())
                    ->method("save")
                    ->with($id, $limits->toArray());

        $limitProvider->refreshLimits($this->request, $response, $limitBy, ["username" => $username]);
    }

    public function testItCorrectlyUsesProvidedHashFunction()
    {
        $expectedLimitBy = "foo";
        $expectedCtx = ["username" => "bar"];
        $expectedId = "foobarbarfoo";

        $hashFunc = function ($limitBy, RequestInterface $request, array $context)
            use ($expectedLimitBy, $expectedCtx, $expectedId) {

            $this->assertSame($expectedLimitBy, $limitBy);
            $this->assertSame($this->request, $request);
            $this->assertSame($expectedCtx, $context);

            return $expectedId;
        };

        $limitProvider = new DoctrineCacheRateLimitProvider($this->cache, $this->limitExtractor, $hashFunc);

        $this->cache->expects($this->once())->method("fetch")
            ->with($expectedId)->willReturn(null);

        $limitProvider->isLimitReached($expectedLimitBy, $this->request, $expectedCtx);

        $response = $this->getMockForAbstractClass(ResponseInterface::class, [], "", false);

        $limits = Limits::create(new \DateTime(), 1, 1, 1, 1);
        $this->limitExtractor->expects($this->once())->method("extractLimits")
            ->with($response)->willReturn($limits);
        $this->cache->expects($this->once())->method("save")
            ->with($expectedId, $limits->toArray());

        $limitProvider->refreshLimits($this->request, $response, $expectedLimitBy, $expectedCtx);
    }
}
