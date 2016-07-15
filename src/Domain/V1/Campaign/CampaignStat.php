<?php

namespace MyTarget\Domain\V1\Campaign;

use MyTarget\Domain\V1\PeriodStat;
use MyTarget\Mapper\Annotation\Field;

class CampaignStat extends Campaign
{
    /**
     * @var PeriodStat
     * @Field(name="stats", type="MyTarget\Domain\V1\PeriodStat")
     */
    private $stats;

    /**
     * @var PeriodStat
     * @Field(name="stats_today", type="MyTarget\Domain\V1\PeriodStat")
     */
    private $statsToday;

    /**
     * @var PeriodStat
     * @Field(name="stats_yesterday", type="MyTarget\Domain\V1\PeriodStat")
     */
    private $statsYesterday;

    /**
     * @var PeriodStat[]
     * @Field(name="stats_full", type="array<MyTarget\Domain\V1\PeriodStat>")
     */
    private $statsFull;

    /**
     * @var \DateTime
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
     * @return \MyTarget\Domain\V1\PeriodStat[]
     */
    public function getStatsFull()
    {
        return $this->statsFull;
    }

    /**
     * @return \DateTime
     */
    public function getLastStatsUpdated()
    {
        return $this->lastStatsUpdated;
    }
}
