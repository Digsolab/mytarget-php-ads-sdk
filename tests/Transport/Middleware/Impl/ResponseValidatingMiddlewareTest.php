<?php

namespace tests\Dsl\MyTarget\Transport\Middleware\Impl;

use Dsl\MyTarget\Limiting\Exception\BannerLimitException;
use GuzzleHttp\Psr7\Request;
use Dsl\MyTarget\Transport\Exception as ex;
use Dsl\MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Dsl\MyTarget\Transport\Middleware\Impl\ResponseValidatingMiddleware;
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
     * @param string|null $exception
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

        if ($exception !== null) {
            $this->setExpectedException($exception);
        }

        $middleware = new ResponseValidatingMiddleware();
        $middleware->request($request, $stack);
    }

    /**
     * @dataProvider bodyParsingProvider
     *
     * @param string $body
     */
    public function testBodyParsing($body)
    {
        $request = new Request('GET', '/', ['X-Phpunit' => ['a', 'b']], 'some request data');

        $response = $this->getMock(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(400);
        $response->method('getBody')->willReturn($body);

        /** @var HttpMiddlewareStack|\PHPUnit_Framework_MockObject_MockObject $stack */
        $stack = $this->getMockBuilder(HttpMiddlewareStack::class)
                      ->disableOriginalConstructor()
                      ->getMock();

        $stack->expects(self::once())
              ->method('request')
              ->with($request)
              ->willReturn($response);

        $this->setExpectedException(BannerLimitException::class);

        $middleware = new ResponseValidatingMiddleware();
        $middleware->request($request, $stack);
    }

    public function bodyParsingProvider()
    {
        return [
            ['Active banners limit exceeded.'],
            ['Active banners limit exceeded'],
            ['active banners limit exceeded'],
            ['ACTIVE banners LIMIT exceeded'],
        ];
    }
}
