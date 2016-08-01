<?php

namespace tests\MyTarget\Transport\Middleware\Impl;

use GuzzleHttp\Psr7\Request;
use MyTarget\Transport\Exception as ex;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use MyTarget\Transport\Middleware\Impl\ResponseValidatingMiddleware;
use Psr\Http\Message\ResponseInterface;

class ResponseValidatingMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    public function testDataProvider()
    {
        return [
            '500' => [500, ex\ServerErrorException::class],
            '400' => [400, ex\ClientErrorException::class],
            '300' => [300, ex\RequestException::class],

            '200' => [200, null],
        ];
    }

    /**
     * @dataProvider testDataProvider
     *
     * @param int    $code
     * @param string $exception
     */
    public function testRequestStatusCode($code, $exception)
    {
        $request = new Request('GET', '/', ['X-Phpunit' => ['a', 'b']], 'some request data');

        $response = $this->getMock(ResponseInterface::class);
        $response->method('getStatusCode')
            ->willReturn($code);

        /** @var HttpMiddlewareStack|\PHPUnit_Framework_MockObject_MockObject $stack */
        $stack = $this->getMockBuilder(HttpMiddlewareStack::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stack->expects(self::once())
            ->method('request')
            ->with($request)
            ->willReturn($response);

        $this->setExpectedException($exception);

        $middleware = new ResponseValidatingMiddleware();
        $middleware->request($request, $stack);
    }
}
