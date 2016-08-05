<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

use Dsl\MyTarget\Mapper\Annotation\Field;

class HourStat extends DatedStat
{
    /**
     * @var \DateTime
     * @Field(type="DateTime<d.m.Y H:i:s>")
     */
    private $date;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
