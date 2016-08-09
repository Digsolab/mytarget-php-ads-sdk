<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

abstract class DatedStat extends StatisticRow
{
    /**
     * @return \DateTime
     */
    public abstract function getDate();
}
