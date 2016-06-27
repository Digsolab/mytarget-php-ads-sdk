<?php

namespace MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

class HeaderLimitExtractorTest extends \PHPUnit_Framework_TestCase
{
    protected $response;
    
    protected function setUp()
    {
        $this->response = $this->getMock(ResponseInterface::class);
    }
    
    public function testItExtractsLimits()
    {
        $limitExtractor = new HeaderLimitExtractor();

        $this->response->expects($this->exactly(8))
                       ->method('hasHeader')
                       ->withConsecutive(
                           ['X-RateLimit-RPS-Limit'],
                           ['X-RateLimit-RPS-Remaining'],
                           ['X-RateLimit-Minutely-Limit'],
                           ['X-RateLimit-Minutely-Remaining'],
                           ['X-RateLimit-Hourly-Limit'],
                           ['X-RateLimit-Hourly-Remaining'],
                           ['X-RateLimit-Daily-Limit'],
                           ['X-RateLimit-Daily-Remaining']
                       )
                       ->will($this->onConsecutiveCalls(true, true, true, true, true, true, true, true))
        ;

        $this->response->expects($this->exactly(8))
                       ->method('getHeader')
                       ->withConsecutive(
                           ['X-RateLimit-RPS-Limit'],
                           ['X-RateLimit-RPS-Remaining'],
                           ['X-RateLimit-Minutely-Limit'],
                           ['X-RateLimit-Minutely-Remaining'],
                           ['X-RateLimit-Hourly-Limit'],
                           ['X-RateLimit-Hourly-Remaining'],
                           ['X-RateLimit-Daily-Limit'],
                           ['X-RateLimit-Daily-Remaining']
                       )
                       ->will($this->onConsecutiveCalls('1', '2', '3', '4', '5', '6', '7', '0'))
        ;

        $result = $limitExtractor->extractLimits($this->response);

        $limits = [
            'X-RateLimit-RPS-Limit' => 1,
            'X-RateLimit-RPS-Remaining' => 2,
            'X-RateLimit-Minutely-Limit' => 3,
            'X-RateLimit-Minutely-Remaining' => 4,
            'X-RateLimit-Hourly-Limit' => 5,
            'X-RateLimit-Hourly-Remaining' => 6,
            'X-RateLimit-Daily-Limit' => 7,
            'X-RateLimit-Daily-Remaining' => 0,
        ];

        $this->assertEquals($limits, $result);
    }
}
