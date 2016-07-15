<?php

namespace MyTarget\Domain\V1\Statistic;

use MyTarget\Mapper\Annotation\Field;

class ObjectDailyStat extends ObjectStat
{
    /**
     * @var DayStat[]
     * @Field(name="detailed_stat", type="array<MyTarget\Domain\V1\Statistic\DayStat>")
     */
    private $detailed;

    /**
     * @return DayStat[]
     */
    public function getDetailed()
    {
        return $this->detailed;
    }
}
