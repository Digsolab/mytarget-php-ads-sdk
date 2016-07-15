<?php

namespace MyTarget\Domain\V1\Statistic;

use MyTarget\Mapper\Annotation\Field;

class ObjectHourlyStat extends ObjectStat
{
    /**
     * @var HourStat[]
     * @Field(name="detailed_stat", type="array<MyTarget\Domain\V1\Statistic\HourStat>")
     */
    private $detailed;

    /**
     * @return HourStat[]
     */
    public function getDetailed()
    {
        return $this->detailed;
    }
}
