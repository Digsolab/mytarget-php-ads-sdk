<?php

namespace MyTarget\Mapper\Type;

use MyTarget\Mapper\Mapper;

class ScalarTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|Mapper */
    protected $mapper;

    protected function setUp()
    {
        $this->mapper = $this->getMockBuilder(Mapper::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @dataProvider hydratedValues
     * @param string $type
     * @param mixed $value
     * @param mixed $hydrated
     */
    public function testItHydrates($type, $value, $hydrated)
    {
        $scalarType = new ScalarType();

        $result = $scalarType->hydrated($value, $type, $this->mapper);

        $this->assertSame($hydrated, $result);
    }

    /**
     * @dataProvider snapshotValues
     * @param $type
     * @param $value
     * @param $snapshot
     */
    public function testItMakesSnapshot($value, $snapshot)
    {
        $scalarType = new ScalarType();

        $result = $scalarType->snapshot($value, 'anyType', $this->mapper);

        $this->assertSame($snapshot, $result);
    }

    public function hydratedValues()
    {
        // result type, input value, result value
        return [
            'integer from integer' => ['int', 1, 1],
            'integer from float' => ['int', 1.2, 1],
            'integer from positive float with exponent' => ['int', 1.0e3, 1000],
            'integer from negative float with exponent' => ['int', -1.0e3, -1000],
            'integer from string with integer' => ['int', '1', 1],
            'integer from string with float' => ['int', '1.2', 1],
            'integer from string with letters after float' => ['int', '1.2USD', 1],
            'integer from string with negative integer' => ['int', '-1', -1],
            'integer from string beginning with letters' => ['int', 'qwerty18', 0],
            'integer from string with positive exponent' => ['int', '1.0e3', (version_compare(PHP_VERSION, '7.1.0beta1') >= 0) ? 1000 : 1],
            'integer from string with negative exponent' => ['int', '-1.0e3', (version_compare(PHP_VERSION, '7.1.0beta1') >= 0) ? -1000 : -1],
            'integer from positive boolean' => ['int', true, 1],
            'integer from negative boolean' => ['int', false, 0],

            'boolean from negative boolean' => ['bool', false, false],
            'boolean from integer zero' => ['bool', 0, false],
            'boolean from float zero' => ['bool', 0.0, false],
            'boolean from empty string' => ['bool', '', false],
            'boolean from string zero' => ['bool', '0', false],
            'boolean from empty array' => ['bool', [], false],
            'boolean from null' => ['bool', null, false],
            'boolean from positive boolean' => ['bool', true, true],
            'boolean from positive integer' => ['bool', 1, true],
            'boolean from negative integer' => ['bool', -1, true],
            'boolean from non-empty string' => ['bool', 'A', true],

            'float from float' => ['float', 1.2, 1.2],
            'float from positive integer' => ['float', 1, 1.0],
            'float from negative integer' => ['float', -1, -1.0],
            'float from positive boolean' => ['float', true, 1.0],
            'float from negative boolean' => ['float', false, 0.0],
            'float from string with positive float' => ['float', '1.2', 1.2],
            'float from string with negative float' => ['float', '-1.2', -1.2],
            'float from string with letters after float' => ['float', '1.2USD', 1.2],

            'string from string' => ['string', 'A', 'A'],
            'string from positive boolean' => ['string', true, '1'],
            'string from negative boolean' => ['string', false, ''],
            'string from positive integer' => ['string', 1, '1'],
            'string from negative integer' => ['string', -1, '-1'],
            'string from positive float' => ['string', 1.2, '1.2'],
            'string from negative float' => ['string', -1.2, '-1.2'],
            'string from positive float with exponent' => ['string', 1.0e3, '1000'],
            'string from negative float with exponent' => ['string', -1.0e3, '-1000'],

            'null from unknown type' => ['someType', 'someInputValue', null],
        ];
    }

    public function snapshotValues()
    {
        // input value, result value
        return [
            'null from array' => [[], null],
            'null from resource' => [fopen(__FILE__, 'r'), null],
            'null from object' => [new \stdClass(), null],

            'integer from integer' => [1, 1],
            'float from float' => [1.2, 1.2],
            'string from string' => ['A', 'A'],
            'boolean from negative boolean' => [false, false],
            'boolean from positive boolean' => [true, true],
        ];
    }
}
