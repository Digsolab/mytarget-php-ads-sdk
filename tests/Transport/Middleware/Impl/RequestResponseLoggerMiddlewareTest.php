<?php

namespace MyTarget\Transport\Middleware\Impl;

use GuzzleHttp\Psr7 as psr;
use GuzzleHttp\Psr7\Request;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class RequestResponseLoggerMiddlewareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function testRequestDataProvider()
    {
        return [
            'with context' => [['username' => 'tro-lo-lo']],
            'without context' => [null],
        ];
    }

    /**
     * @dataProvider testRequestDataProvider
     *
     * @param array|null $context
     */
    public function testRequest(array $context = null)
    {
        /** @var LoggerInterface|\PHPUnit_Framework_MockObject_MockObject $logger */
        $logger = $this->getMock(LoggerInterface::class);

        $middleware = new RequestResponseLoggerMiddleware($logger);

        $request = new Request('GET', '/', ['X-Phpunit' => ['a', 'b']], 'some request data');

        $response = $this->getMock(ResponseInterface::class);
        $response->method('getHeaders')->willReturn(['X-Ok' => ['1']]);
        $response->method('getBody')->willReturn(psr\stream_for('{"json": true}'));
        $response->method('getProtocolVersion')->willReturn('1.1');
        $response->method('getStatusCode')->willReturn(200);

        /** @var HttpMiddlewareStack|\PHPUnit_Framework_MockObject_MockObject $stack */
        $stack = $this->getMockBuilder(HttpMiddlewareStack::class)->disableOriginalConstructor()->getMock();

        $logger->expects(self::at(0))
            ->method('info')
            ->with("MyTarget request:\nProtocol: 1.1\nMethod: GET\nURI: /\nHeaders:\nX-Phpunit: a\nX-Phpunit: b\nBody: some request data", $context ?: []);

        $stack->expects(self::once())
          ->method('request')
          ->with($request, $context)
          ->willReturn($response);

        $logger->expects(self::at(1))
           ->method('info')
           ->with("MyTarget response:\nProtocol: 1.1\nCode: 200\nHeaders:\nX-Ok: 1\nBody: {\"json\": true}", $context ?: []);

        $middleware->request($request, $stack, $context);
    }
}
