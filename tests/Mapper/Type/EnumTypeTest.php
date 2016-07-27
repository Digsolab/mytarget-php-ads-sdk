<?php

namespace MyTarget\Mapper\Type;

use MyTarget\Mapper\Mapper;

class EnumTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|RateLimitProvider */
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

        $result = $enumType->hydrated(777, 'MyTarget\Mapper\Type\EnumTypeMock', $this->mapper);

        $this->assertInstanceOf('MyTarget\Mapper\Type\EnumTypeMock', $result);

        $this->assertSame(EnumTypeMock::TEST_CONST_VAL, $result->getValue());
    }

    public function testItHydratesWithNullIfValueNotValid()
    {
        $enumType = new EnumType();

        $result = $enumType->hydrated(111, 'MyTarget\Mapper\Type\EnumTypeMock', $this->mapper);

        $this->assertSame(null, $result);
    }

    public function testItMakesSnapshot()
    {
        $enumType = new EnumType();

        $enum = EnumTypeMock::fromValue(777);

        $result = $enumType->snapshot($enum, 'MyTarget\Mapper\Type\EnumTypeMock', $this->mapper);

        $this->assertSame(777, $result);
    }

    public function testItMakesSnapshotAsNullIfValueObjectIsOfWrongType()
    {
        $enumType = new EnumType();

        $result = $enumType->snapshot(new \stdClass(), 'MyTarget\Mapper\Type\EnumTypeMock', $this->mapper);

        $this->assertSame(null, $result);
    }
}
