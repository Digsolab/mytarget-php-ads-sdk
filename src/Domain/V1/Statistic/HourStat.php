<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

use Dsl\MyTarget\Mapper\Annotation\Field;

class HourStat extends StatisticRow
{
    /**
     * @var \DateTimeImmutable
     * @Field(type="DateTime<d.m.Y H:i>")
     */
    private $date;

    /**
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }
}
