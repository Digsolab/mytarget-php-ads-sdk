<?php

namespace tests\Dsl\MyTarget\Limiting;

use GuzzleHttp\Psr7\Response;
use Dsl\MyTarget\Limiting\HeaderLimitExtractor;
use Dsl\MyTarget\Limiting\Limits;

class HeaderLimitExtractorTest extends \PHPUnit_Framework_TestCase
{
    public function testItExtractsLimits()
    {
        $limitExtractor = new HeaderLimitExtractor();

        $response = new Response(200, [
            "X-RateLimit-RPS-Remaining" => 1,
            "X-RateLimit-Minutely-Remaining" => 2,
            "X-RateLimit-Hourly-Remaining" => 3,
            "X-RateLimit-Daily-Remaining" => 4
        ]);

        $result = $limitExtractor->extractLimits($response);

        $expected = new Limits();
        $expected->bySecond = 1;
        $expected->byMinute = 2;
        $expected->byHour = 3;
        $expected->byDay = 4;

        $this->assertEquals($expected, $result);
    }
}
