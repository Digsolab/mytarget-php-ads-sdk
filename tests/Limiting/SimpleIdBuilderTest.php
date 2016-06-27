<?php

namespace MyTarget\Limiting;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class SimpleIdBuilderTest extends \PHPUnit_Framework_TestCase
{
    protected $request;
    protected $path;

    protected function setUp()
    {
        $this->request = $this->getMock(RequestInterface::class);
        $this->path = $this->getMock(UriInterface::class);
    }

    /**
     * @dataProvider provideData
     */
    public function testItBuildsId($path, $method, $username, $id)
    {
        $idBuilder = new SimpleIdBuilder();

        $this->request->expects($this->once())
                      ->method('getUri')
                      ->willReturn($this->path);

        $this->request->expects($this->once())
                      ->method('getMethod')
                      ->willReturn($method);

        $this->path->expects($this->once())
                   ->method('getPath')
                   ->willReturn($path);

        $result = $idBuilder->buildId($this->request, $username);

        $this->assertEquals($id, $result);
    }

    public function provideData()
    {
        return [
            'it bulds id' => [
                '/api/v1/campaigns.json',
                'GET',
                '12345@agency_client',
                '12345@agency_client#GET:/api/v1/campaigns.json'
            ],
            'it substitutes numbers in directory' => [
                '/api/v1/34567/campaigns.json',
                'GET',
                '12345@agency_client',
                '12345@agency_client#GET:/api/v1/PARAM/campaigns.json'
            ],
            'it substitutes numbers in file' => [
                '/api/v1/112233.json',
                'GET',
                '12345@agency_client',
                '12345@agency_client#GET:/api/v1/PARAM.json'
            ],
        ];
    }
}
