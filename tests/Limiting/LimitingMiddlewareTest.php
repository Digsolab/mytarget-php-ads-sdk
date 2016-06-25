<?php

namespace MyTarget\Limiting;

use GuzzleHttp\Psr7\Request;
use MyTarget\Limiting\LimitingMiddleware;
use MyTarget\Limiting\RateLimitProvider;
use MyTarget\Transport\Middleware\Impl\Exception\ThrottleException;
use MyTarget\Transport\HttpTransport;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LimitingMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|RateLimitProvider */
    protected $rateLimitProvider;
    
    public function setUp()
    {
        $this->rateLimitProvider = $this->getMock(RateLimitProvider::class);
    }

    public function testItThrowsThrottlingExceptionWhenNeeded()
    {
        $middleware = new LimitingMiddleware($this->rateLimitProvider);

        $request = new Request("GET", "/");
        $stack = $this->getMockBuilder(HttpMiddlewareStack::class)->disableOriginalConstructor()->getMock();
        $username = "12345@agency_client";
        $context = ["limit-by" => "campaigns-all", "username" => $username];
        $isLimitReached = true;

        $this->rateLimitProvider->expects($this->once())
            ->method("isLimitReached")
            ->with($context["limit-by"], $username)
            ->willReturn($isLimitReached);

        $this->setExpectedException(ThrottleException::class);

        $middleware->request($request, $stack, $context);
    }

    public function testItSavesLimits()
    {
        $middleware = new LimitingMiddleware($this->rateLimitProvider);

        $request = new Request("GET", "/");        $response = $this->getMock(ResponseInterface::class);
        $stack = $this->getMockBuilder(HttpMiddlewareStack::class)->disableOriginalConstructor()->getMock();
        $username = "12345@agency_client";
        $context = ["limit-by" => "campaigns-all", "username" => $username];
        $isLimitReached = false;

        $this->rateLimitProvider->expects($this->once())
                                ->method("isLimitReached")
                                ->with($context["limit-by"], $username)
                                ->willReturn($isLimitReached);

        $stack->expects($this->once())
                   ->method("request")
                   ->with($request, $context)
                   ->willReturn($response);

        $this->rateLimitProvider->expects($this->once())
                                ->method("refreshLimits")
                                ->with($response, $context["limit-by"], $username);

        $middleware->request($request, $stack, $context);
    }
}
