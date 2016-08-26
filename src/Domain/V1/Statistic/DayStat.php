<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

use Dsl\MyTarget\Mapper\Annotation\Field;

class DayStat extends DatedStat
{
    /**
     * @var \DateTimeImmutable
     * @Field(type="DateTime<d.m.Y|>")
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
