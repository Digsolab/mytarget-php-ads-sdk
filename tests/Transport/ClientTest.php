<?php

namespace MyTarget\Transport\Middleware\Impl;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception as guzzleEx;
use GuzzleHttp\Psr7 as psr;
use MyTarget as f;
use MyTarget\Client;
use MyTarget\Transport\Exception as ex;
use MyTarget\Transport\GuzzleHttpTransport;
use MyTarget\Transport\HttpTransport;
use MyTarget\Transport\Middleware\HttpMiddlewareStackPrototype;
use MyTarget\Transport\RequestFactory;
use PHPUnit_Framework_MockObject_MockObject;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testRequestSuccess()
    {
        /** @var HttpTransport|PHPUnit_Framework_MockObject_MockObject $http */
        $http = $this->getMockBuilder(GuzzleHttpTransport::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $http
            ->expects(self::once())
            ->method('request')
            ->willReturn(call_user_func(function() {
                $response = $this->getMock(ResponseInterface::class);
                $response->method('getBody')
                         ->willReturn(psr\stream_for('{"json": true}'));

                return $response;
            }))
        ;

        $client = new Client(
            new RequestFactory(new psr\Uri('https://target.my.com')),
            HttpMiddlewareStackPrototype::newEmpty($http)
        );

        self::assertNotEmpty($client->get('/any/path'));
    }

    /**
     *
     */
    public function testRequestTransportException()
    {
        $guzzle = $this->getMock(ClientInterface::class);
        $guzzle->method('send')
            ->willThrowException(new guzzleEx\ClientException('', $this->getMock(RequestInterface::class)));

        $client = new Client(
            new RequestFactory(new psr\Uri('https://target.my.com')),
            HttpMiddlewareStackPrototype::newEmpty(new GuzzleHttpTransport($guzzle))
        );

        $this->setExpectedException(ex\HttpTransportException::class);

        $client->get('/any/path');
    }
}
