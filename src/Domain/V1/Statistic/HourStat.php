<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

use Dsl\MyTarget\Mapper\Annotation\Field;

class HourStat extends DatedStat
{
    /**
     * @var \DateTimeImmutable
     * @Field(type="DateTime<d.m.Y H:i:s>")
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
