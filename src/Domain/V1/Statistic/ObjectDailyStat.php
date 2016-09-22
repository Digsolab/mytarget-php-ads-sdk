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
     * @var DayStat
     * @Field(type="Dsl\MyTarget\Domain\V1\Statistic\DayStat")
     */
    private $total;

    /**
     * @return DayStat[]
     */
    public function getDetailed()
    {
        return $this->detailed;
    }

    /**
     * @return DayStat
     */
    public function getTotal()
    {
        return $this->total;
    }
}
