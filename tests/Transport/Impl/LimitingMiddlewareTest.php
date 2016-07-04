<?php

namespace MyTarget\Transport\Middleware\Impl;

use MyTarget\Limiting\RateLimitProvider;
use MyTarget\Transport\Middleware\Impl\Exception\ThrottleException;
use MyTarget\Transport\HttpTransport;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LimitingMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $http;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $rateLimitProvider;
    
    public function setUp()
    {
        $this->http = $this->getMock(HttpTransport::class);
        $this->rateLimitProvider = $this->getMock(RateLimitProvider::class);
    }

    public function testItThrowsThrottlingExceptionWhenNeeded()
    {
        $middleware = new LimitingMiddleware($this->http, $this->rateLimitProvider);

        $request = $this->getMock(RequestInterface::class);
        $stack = $this->getMockBuilder(HttpMiddlewareStack::class)->disableOriginalConstructor()->getMock();
        $username = '12345@agency_client';
        $context = ['limit-by' => 'campaigns-all'];
        $isLimitReached = true;

        $this->rateLimitProvider->expects($this->once())
            ->method('isLimitReached')
            ->with($context['limit-by'], $username)
            ->willReturn($isLimitReached);

        $this->setExpectedException(ThrottleException::class);

        $middleware->request($request, $stack, $username, $context);
    }

    public function testItSavesLimits()
    {
        $middleware = new LimitingMiddleware($this->http, $this->rateLimitProvider);

        $request = $this->getMock(RequestInterface::class);
        $response = $this->getMock(ResponseInterface::class);
        $stack = $this->getMockBuilder(HttpMiddlewareStack::class)->disableOriginalConstructor()->getMock();
        $username = '12345@agency_client';
        $context = ['limit-by' => 'campaigns-all'];
        $isLimitReached = false;

        $this->rateLimitProvider->expects($this->once())
                                ->method('isLimitReached')
                                ->with($context['limit-by'], $username)
                                ->willReturn($isLimitReached);

        $stack->expects($this->once())
                   ->method('request')
                   ->with($request, $username, $context)
                   ->willReturn($response);

        $this->rateLimitProvider->expects($this->once())
                                ->method('refreshLimits')
                                ->with($response, $context['limit-by'], $username);

        $middleware->request($request, $stack, $username, $context);
    }
}
