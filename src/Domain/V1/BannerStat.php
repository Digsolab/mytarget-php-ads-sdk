<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class BannerStat extends Banner
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
     * @var Creative[]
     * @Field(type="array<MyTarget\Domain\V1\Creative>")
     */
    private $content;

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
     * @return Creative[]
     */
    public function getContent()
    {
        return $this->content;
    }
}
