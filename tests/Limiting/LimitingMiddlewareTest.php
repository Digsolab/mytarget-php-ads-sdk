<?php

namespace tests\Dsl\MyTarget\Limiting;

use Dsl\MyTarget\Context;
use GuzzleHttp\Psr7\Request;
use Dsl\MyTarget\Limiting\LimitingMiddleware;
use Dsl\MyTarget\Limiting\RateLimitProvider;
use Dsl\MyTarget\Limiting\Exception\ThrottleException;
use Dsl\MyTarget\Transport\Middleware\HttpMiddlewareStack;
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
        $context = new Context($username, "campaigns-all");
        $limitTimeout = 1;

        $this->rateLimitProvider->expects($this->once())
            ->method("rateLimitTimeout")
            ->with($context->getLimitBy(), $request, $context)
            ->willReturn($limitTimeout);

        $this->setExpectedException(ThrottleException::class);

        $middleware->request($request, $stack, $context);
    }

    public function testItSavesLimits()
    {
        $middleware = new LimitingMiddleware($this->rateLimitProvider);

        $request = new Request("GET", "/");
        $response = $this->getMock(ResponseInterface::class);
        $stack = $this->getMockBuilder(HttpMiddlewareStack::class)->disableOriginalConstructor()->getMock();
        $username = "12345@agency_client";
        $context = new Context($username, "12345@agency_client");
        $isLimitReached = false;

        $this->rateLimitProvider->expects($this->once())
                                ->method("rateLimitTimeout")
                                ->with($context->getLimitBy(), $request, $context)
                                ->willReturn($isLimitReached);

        $stack->expects($this->once())
                   ->method("request")
                   ->with($request, $context)
                   ->willReturn($response);

        $this->rateLimitProvider->expects($this->once())
                                ->method("refreshLimits")
                                ->with($request, $response, $context->getLimitBy(), $context);

        $middleware->request($request, $stack, $context);
    }
}
