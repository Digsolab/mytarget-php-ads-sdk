<?php

namespace Dsl\MyTarget\Domain\V1\Campaign;

use Dsl\MyTarget\Domain\V1\PeriodStat;
use Dsl\MyTarget\Mapper\Annotation\Field;

class CampaignStat extends Campaign
{
    /**
     * @var PeriodStat
     * @Field(name="stats", type="Dsl\MyTarget\Domain\V1\PeriodStat")
     */
    private $stats;

    /**
     * @var PeriodStat
     * @Field(name="stats_today", type="Dsl\MyTarget\Domain\V1\PeriodStat")
     */
    private $statsToday;

    /**
     * @var PeriodStat
     * @Field(name="stats_yesterday", type="Dsl\MyTarget\Domain\V1\PeriodStat")
     */
    private $statsYesterday;

    /**
     * @var PeriodStat[]
     * @Field(name="stats_full", type="array<Dsl\MyTarget\Domain\V1\PeriodStat>")
     */
    private $statsFull;

    /**
     * @var \DateTimeImmutable
     * @Field(name="last_stats_updated", type="DateTime")
     */
    private $lastStatsUpdated;

    /**
     * @return PeriodStat
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @return PeriodStat
     */
    public function getStatsToday()
    {
        return $this->statsToday;
    }

    /**
     * @return PeriodStat
     */
    public function getStatsYesterday()
    {
        return $this->statsYesterday;
    }

    /**
     * @return PeriodStat[]
     */
    public function getStatsFull()
    {
        return $this->statsFull;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLastStatsUpdated()
    {
        return $this->lastStatsUpdated;
    }
}
