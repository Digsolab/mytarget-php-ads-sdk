<?php

namespace tests\MyTarget\Mapper\Type;

use MyTarget\Mapper\Mapper;
use MyTarget\Mapper\Type\ArrayType;

class ArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|Mapper */
    protected $mapper;

    protected function setUp()
    {
        $this->mapper = $this->getMockBuilder(Mapper::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testItHydratesNonArrayAsNull()
    {
        $arrayType = new ArrayType();

        $result = $arrayType->hydrated(1, 'anyType', $this->mapper);

        $this->assertEquals(null, $result);
    }

    public function testItHydratesArrayWithoutModificationIfNoInnerTypeProvided()
    {
        $arrayType = new ArrayType();

        $result = $arrayType->hydrated([1, 1.2, 'A', true], 'array', $this->mapper);

        $this->assertEquals([1, 1.2, 'A', true], $result);
    }

    public function testItHydratesArrayUsingMapperWhenInnerTypeProvided()
    {
        $arrayType = new ArrayType();

        $this->mapper->expects($this->exactly(4))
            ->method('hydrateNew')
            ->withConsecutive(
                ['string', 'A'],
                ['string', 'B'],
                ['string', 'C'],
                ['string', 'D']
            )
            ->willReturnOnConsecutiveCalls(
                'A',
                'B',
                'C',
                'D'
            );

        $result = $arrayType->hydrated(['A', 'B', 'C', 'D'], 'array<string>', $this->mapper);

        $this->assertEquals(['A', 'B', 'C', 'D'], $result);
    }

    public function testItHydratesArraySkippingItemsWithWrongType()
    {
        $arrayType = new ArrayType();

        $this->mapper->expects($this->exactly(4))
                     ->method('hydrateNew')
                     ->withConsecutive(
                         ['string', 'A'],
                         ['string', 'B'],
                         ['string', 1],
                         ['string', false]
                     )
                     ->willReturnOnConsecutiveCalls(
                         'A',
                         'B',
                         null,
                         null
                     );

        $result = $arrayType->hydrated(['A', 'B', 1, false], 'array<string>', $this->mapper);

        $this->assertEquals(['A', 'B'], $result);
    }

    public function testItMakesSnapshotFromNonArrayAsNull()
    {
        $arrayType = new ArrayType();

        $result = $arrayType->snapshot(1, 'anyType', $this->mapper);

        $this->assertSame(null, $result);
    }

    public function testItMakesSnapshotFromArrayWithoutModificationIfNoInnerTypeProvided()
    {
        $arrayType = new ArrayType();

        $result = $arrayType->snapshot([1, 1.2, 'A', true], 'array', $this->mapper);

        $this->assertEquals([1, 1.2, 'A', true], $result);
    }

    public function testItMakesSnapshotFromArrayUsingMapperWhenInnerTypeProvided()
    {
        $arrayType = new ArrayType();

        $this->mapper->expects($this->exactly(4))
                     ->method('snapshot')
                     ->withConsecutive(
                         ['A', 'string'],
                         ['B', 'string'],
                         ['C', 'string'],
                         ['D', 'string']
                     )
                     ->willReturnOnConsecutiveCalls(
                         'A',
                         'B',
                         'C',
                         'D'
                     );

        $result = $arrayType->snapshot(['A', 'B', 'C', 'D'], 'array<string>', $this->mapper);

        $this->assertEquals(['A', 'B', 'C', 'D'], $result);
    }

    public function testItMakesSnapshotFromArraySkippingItemsWithWrongType()
    {
        $arrayType = new ArrayType();

        $this->mapper->expects($this->exactly(4))
                     ->method('snapshot')
                     ->withConsecutive(
                         ['A', 'string'],
                         ['B', 'string'],
                         [1, 'string'],
                         [false, 'string']
                     )
                     ->willReturnOnConsecutiveCalls(
                         'A',
                         'B',
                         null,
                         null
                     );

        $result = $arrayType->snapshot(['A', 'B', 1, false], 'array<string>', $this->mapper);

        $this->assertEquals(['A', 'B'], $result);
    }
}
