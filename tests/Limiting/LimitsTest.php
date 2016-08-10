<?php

namespace tests\Dsl\MyTarget\Limiting;

use Dsl\MyTarget\Limiting\Limits;

class LimitsTest extends \PHPUnit_Framework_TestCase
{

    public function buildFromArrayDataProvider()
    {
        return [
            [
                [],
                null,
                null,
                null,
                null,
                null,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                null,
                null,
                null,
                null,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000', 'by_second' => '2'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                2,
                null,
                null,
                null,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000', 'by_second' => 'abc'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                null,
                null,
                null,
                null,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000', 'by_second' => '4', 'by_minute' => '63'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                4,
                63,
                null,
                null,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000', 'by_second' => '4', 'by_minute' => 'zzz'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                4,
                null,
                null,
                null,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000', 'by_second' => '4', 'by_minute' => '63', 'by_hour' => '1'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                4,
                63,
                1,
                null,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000', 'by_second' => '4', 'by_minute' => '63', 'by_hour' => 'bar'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                4,
                63,
                null,
                null,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000', 'by_second' => '4', 'by_minute' => '63', 'by_hour' => '1', 'by_day' => '55'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                4,
                63,
                1,
                55,
            ],
            [
                ['moment' => '2016-01-01T00:00:00+0000', 'by_second' => '4', 'by_minute' => '63', 'by_hour' => '1', 'by_day' => 'ddddd'],
                new \DateTimeImmutable('2016-01-01T00:00:00+0000'),
                4,
                63,
                1,
                null,
            ],
        ];
    }

    /**
     * @param array $data
     * @param mixed $moment
     * @param mixed $bySecond
     * @param mixed $byMinute
     * @param mixed $byHour
     * @param mixed $byDay
     *
     * @dataProvider buildFromArrayDataProvider
     */
    public function testBuildFromArray(array $data, $moment, $bySecond, $byMinute, $byHour, $byDay)
    {
        $limits = Limits::buildFromArray($data);

        $this->assertEquals($moment, $limits->getMoment());
        $this->assertSame($bySecond, $limits->getBySecond());
        $this->assertSame($byMinute, $limits->getByMinute());
        $this->assertSame($byHour, $limits->getByHour());
        $this->assertSame($byDay, $limits->getByDay());
    }

}
