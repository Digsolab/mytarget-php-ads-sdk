<?php

namespace MyTarget\Limiting;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class SimpleIdBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testItBuildsId($limitBy, $username, $id)
    {
        $idBuilder = new SimpleIdBuilder();

        $result = $idBuilder->buildId($limitBy, $username);

        $this->assertEquals($id, $result);
    }

    public function provideData()
    {
        return [
            "it builds id" => [
                "campaigns-all",
                "12345@agency_client",
                "campaigns-all#12345@agency_client"
            ],
            "it accepts null as username" => [
                "campaigns-all",
                null,
                "campaigns-all#"
            ]
        ];
    }
}
