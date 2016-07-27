<?php

namespace MyTarget\Mapper\Type;

use Doctrine\Common\Annotations\Reader;
use MyTarget\Mapper\Annotation\Field;
use MyTarget\Mapper\Exception\ContextAwareException;
use MyTarget\Mapper\Mapper;
use MyTarget\Mapper\Exception\ClassNotFoundException;

class ObjectTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|RateLimitProvider */
    protected $instantiator;
    /** @var \PHPUnit_Framework_MockObject_MockObject|RateLimitProvider */
    protected $annotations;
    /** @var \PHPUnit_Framework_MockObject_MockObject|RateLimitProvider */
    protected $mapper;

    protected function setUp()
    {
        $this->instantiator = $this->getMockBuilder(ObjectInstantiatorMock::class)
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->annotations = $this->getMockBuilder(Reader::class)
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->mapper = $this->getMockBuilder(Mapper::class)
                             ->disableOriginalConstructor()
                             ->getMock();
    }

    /**
     * @expectedException \MyTarget\Mapper\Exception\ClassNotFoundException
     */
    public function testItHydratesAndPanicsIfClassNotFound()
    {
        $objectType = new ObjectType($this->annotations);

        $objectType->hydrated(new \stdClass(), 'Some\Class\Name', $this->mapper);
    }

    public function testItHydrates()
    {
        $objectType = new ObjectType($this->annotations);

        $class = new \ReflectionClass('MyTarget\Mapper\Type\ObjectStub');

        $this->annotations->expects($this->once())
            ->method('getPropertyAnnotation')
            ->with($class->getProperty('integerValue'), Field::class)
            ->willReturn(new Field(['type' => 'int', 'name' => 'integerValue']));

        $this->mapper->expects($this->once())
            ->method('hydrateNew')
            ->with('int', 1)
            ->willReturn(1);

        /** @var ObjectStub $result */
        $result = $objectType->hydrated(
            [
                'integerValue' => 1
            ],
            'MyTarget\Mapper\Type\ObjectStub',
            $this->mapper
        );

        $this->assertInstanceOf('MyTarget\Mapper\Type\ObjectStub', $result);

        $this->assertSame(1, $result->getIntegerValue());
    }

    /**
     * @expectedException \MyTarget\Mapper\Exception\ContextAwareException
     */
    public function testItHydratesAndRethrowsException()
    {
        $objectType = new ObjectType($this->annotations);

        $class = new \ReflectionClass('MyTarget\Mapper\Type\ObjectStub');

        $this->annotations->expects($this->once())
                          ->method('getPropertyAnnotation')
                          ->with($class->getProperty('integerValue'), Field::class)
                          ->willReturn(new Field(['type' => 'int', 'name' => 'integerValue']));

        $this->mapper->expects($this->once())
                     ->method('hydrateNew')
                     ->willThrowException(new ContextUnawareExceptionStub());

        $objectType->hydrated(
            [
                'integerValue' => 1
            ],
            'MyTarget\Mapper\Type\ObjectStub',
            $this->mapper
        );
    }
}
