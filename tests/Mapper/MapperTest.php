<?php

namespace tests\MyTarget\Mapper;

use MyTarget\Mapper\Mapper;
use MyTarget\Mapper\Type\ArrayType;
use MyTarget\Mapper\Type\ScalarType;
use MyTarget\Mapper\Type\MixedType;
use MyTarget\Mapper\Type\EnumType;
use MyTarget\Mapper\Type\ObjectType;
use tests\MyTarget\Mapper\Type\EnumTypeMock;

class MapperTest extends \PHPUnit_Framework_TestCase
{
    protected $types;

    public function setUp()
    {
        $this->types = [
            'array' => $this->getMock(ArrayType::class),
            'scalar' => $this->getMock(ScalarType::class),
            'mixed' => $this->getMock(MixedType::class),
            'enum' => $this->getMock(EnumType::class),
            'object' => $this->getMockBuilder(ObjectType::class)->disableOriginalConstructor()->getMock()
        ];
    }

    /**
     * @dataProvider hydratedValues
     * @param $value
     * @param $type
     * @param $hydratedValue
     */
    public function testItHydrates($value, $type, $typeName, $hydratedValue)
    {
        $mapper = new Mapper($this->types);

        /** @var \PHPUnit_Framework_MockObject_MockObject $typeObject */
        $typeObject = $this->types[$type];

        $typeObject->expects($this->once())
            ->method('hydrated')
            ->with($value, $typeName, $mapper)
            ->willReturn($hydratedValue);

        $result = $mapper->hydrateNew($typeName, $value);

        $this->assertSame($hydratedValue, $result);
    }

    /**
     * @expectedException \MyTarget\Mapper\Exception\TypeParsingException
     */
    public function testItHydratesAndPanicsIfTypeNotGiven()
    {
        $mapper = new Mapper($this->types);

        $mapper->hydrateNew('', 'someValue');
    }

    /**
     * @dataProvider snapshotValues
     * @param $value
     * @param $type
     * @param $typeName
     * @param $snapshot
     */
    public function testItMakesSnapshot($value, $type, $typeName, $snapshot)
    {
        $mapper = new Mapper($this->types);

        /** @var \PHPUnit_Framework_MockObject_MockObject $typeObject */
        $typeObject = $this->types[$type];

        $typeObject->expects($this->once())
                   ->method('snapshot')
                   ->with($value, $typeName, $mapper)
                   ->willReturn($snapshot);

        $result = $mapper->snapshot($value, $typeName);

        $this->assertSame($snapshot, $result);
    }

    /**
     * @expectedException \MyTarget\Mapper\Exception\TypeParsingException
     */
    public function testItMakesSnapshotAndPanicsIfTypeNotGiven()
    {
        $mapper = new Mapper($this->types);

        $mapper->snapshot('someValue', '');
    }

    public function testItMakesSnapshotAndDetectsObjectClass()
    {
        $mapper = new Mapper($this->types);

        /** @var \PHPUnit_Framework_MockObject_MockObject $typeObject */
        $typeObject = $this->types['object'];

        $data = new \stdClass();

        $typeObject->expects($this->once())
                   ->method('snapshot')
                   ->with($data, 'stdClass', $mapper)
                   ->willReturn([]);

        $mapper->snapshot($data);
    }

    public function hydratedValues()
    {
        return [
            [[1, 2], 'array', 'array', [1, 2]],
            [[1, 2], 'array', 'array<int>', [1, 2]],
            [1, 'scalar', 'int', 1],
            [1.3, 'scalar', 'float', 1.3],
            [true, 'scalar', 'bool', true],
            ['Abc', 'scalar', 'string', 'Abc'],
            ['mixed', 'mixed', 'mixed', 'mixed'],
            [777, 'enum', EnumTypeMock::class, EnumTypeMock::fromValue(777)],
            [['integerValue' => 5], 'object', '\stdClass', (object)['integerValue' => 5]]
        ];
    }

    public function snapshotValues()
    {
        return [
            [[1, 2], 'array', 'array', [1, 2]],
            [['A', 'B'], 'array', 'array<string>', ['A', 'B']],
            [1, 'scalar', 'int', 1],
            [1.3, 'scalar', 'float', 1.3],
            [true, 'scalar', 'bool', true],
            ['Abc', 'scalar', 'string', 'Abc'],
            ['mixed', 'mixed', 'mixed', 'mixed'],
            [EnumTypeMock::fromValue(777), 'enum', EnumTypeMock::class, 777],
            [(object)['integerValue' => 5], 'object', '\stdClass', ['integerValue' => 5]]
        ];
    }
}
