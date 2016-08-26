<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

use Dsl\MyTarget\Mapper\Annotation\Field;

class ObjectDailyStat extends ObjectStat
{
    /**
     * @var DayStat[]
     * @Field(name="detailed_stat", type="array<Dsl\MyTarget\Domain\V1\Statistic\DayStat>")
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
