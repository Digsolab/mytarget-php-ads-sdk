<?php

namespace tests\Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Mapper\Type\DateTimeType;

class DateTimeTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject|Mapper */
    protected $mapper;

    protected function setUp()
    {
        $this->mapper = $this->getMockBuilder(Mapper::class)
             ->disableOriginalConstructor()
             ->getMock();
    }

    public function testItHydratesFromStandardFormatAndTimeZone()
    {
        $datetimeType = new DateTimeType();

        $result = $datetimeType->hydrated('2016-07-27 13:58:27', 'DateTime', $this->mapper);

        $this->assertEquals(
            \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                '2016-07-27 13:58:27',
                new \DateTimeZone('Europe/Moscow')
            ),
            $result
        );
    }

    public function testItHydratesUsingTimeZone()
    {
        $datetimeType = new DateTimeType(new \DateTimeZone('Pacific/Chuuk'));

        $result = $datetimeType->hydrated('2016-07-27 13:58:27', 'DateTime', $this->mapper);

        $this->assertEquals(
            \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                '2016-07-27 13:58:27',
                new \DateTimeZone("Pacific/Chuuk")
            ),
            $result
        );
    }

    public function testItHydratesUsingFormatAndTimeZone()
    {
        $datetimeType = new DateTimeType(new \DateTimeZone('Pacific/Chuuk'));

        $result = $datetimeType->hydrated('_20160727135827_', 'DateTime<_YmdHis_>', $this->mapper);

        $this->assertEquals(
            \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                '2016-07-27 13:58:27',
                new \DateTimeZone("Pacific/Chuuk")
            ),
            $result
        );
    }

    public function testItHydratesWithNullIfWrongString()
    {
        $datetimeType = new DateTimeType(new \DateTimeZone('Pacific/Chuuk'));

        $result = $datetimeType->hydrated('_20160some7271358mess27_', 'DateTime<_YmdHis_>', $this->mapper);

        $this->assertSame(null, $result);
    }

    public function testItHydratesWithNullIfWrongStandardString()
    {
        $datetimeType = new DateTimeType();

        $result = $datetimeType->hydrated('2some016-07-27 messy13:58:2stuff7', 'DateTime<_YmdHis_>', $this->mapper);

        $this->assertSame(null, $result);
    }

    public function testItMakesSnapshotAsNullIfWrongTypeInputReceived()
    {
        $datetimeType = new DateTimeType();

        $result = $datetimeType->snapshot('date and time string', 'anyType', $this->mapper);

        $this->assertSame(null, $result);
    }

    public function testItMakesSnapshotWithStandardFormatAndTimeZone()
    {
        $datetimeType = new DateTimeType();

        $result = $datetimeType->snapshot(
            \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                '2016-07-27 13:58:27',
                new \DateTimeZone('Europe/Moscow')
            ),
            'DateTime', $this->mapper
        );

        $this->assertEquals(
            '2016-07-27 13:58:27',
            $result
        );
    }

    public function testItMakesSnapshotUsingTimeZone()
    {
        $datetimeType = new DateTimeType(new \DateTimeZone('Pacific/Chuuk'));

        $result = $datetimeType->snapshot(
            \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                '2016-07-27 13:58:27',
                new \DateTimeZone("Pacific/Chuuk")
            ),
            'DateTime',
            $this->mapper
        );

        $this->assertEquals(
            '2016-07-27 13:58:27',
            $result
        );
    }

    public function testItMakesSnapshotUsingFormatAndTimeZone()
    {
        $datetimeType = new DateTimeType(new \DateTimeZone('Pacific/Chuuk'));

        $result = $datetimeType->snapshot(
            \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                '2016-07-27 13:58:27',
                new \DateTimeZone("Pacific/Chuuk")
            ),
            'DateTime<_YmdHis_>',
            $this->mapper
        );

        $this->assertEquals('_20160727135827_', $result);
    }
}
