<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

abstract class DatedStat extends StatisticRow
{
    /**
     * @return \DateTimeImmutable
     */
    public abstract function getDate();
}
