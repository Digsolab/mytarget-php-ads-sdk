<?php

namespace tests\Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Mapper\Type\EnumType;

class EnumTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|Mapper */
    protected $mapper;

    protected function setUp()
    {
        $this->mapper = $this->getMockBuilder(Mapper::class)
                             ->disableOriginalConstructor()
                             ->getMock();
    }

    public function testItHydratesWithValueObject()
    {
        $enumType = new EnumType();

        $result = $enumType->hydrated(777, EnumTypeMock::class, $this->mapper);

        $this->assertInstanceOf(EnumTypeMock::class, $result);

        $this->assertSame(EnumTypeMock::TEST_CONST_VAL, $result->getValue());
    }

    public function testItHydratesWithNullIfValueNotValid()
    {
        $enumType = new EnumType();

        $result = $enumType->hydrated(111, EnumTypeMock::class, $this->mapper);

        $this->assertSame(null, $result);
    }

    public function testItMakesSnapshot()
    {
        $enumType = new EnumType();

        $enum = EnumTypeMock::fromValue(777);

        $result = $enumType->snapshot($enum, EnumTypeMock::class, $this->mapper);

        $this->assertSame(777, $result);
    }

    public function testItMakesSnapshotAsNullIfValueObjectIsOfWrongType()
    {
        $enumType = new EnumType();

        $result = $enumType->snapshot(new \stdClass(), EnumTypeMock::class, $this->mapper);

        $this->assertSame(null, $result);
    }
}
