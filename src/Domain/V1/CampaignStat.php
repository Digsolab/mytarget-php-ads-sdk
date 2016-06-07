<?php

namespace MyTarget\Domain\V1;

use MyTarget\DomainFactory;
use MyTarget\Util\DataAccess\DataAccess;

class CampaignStat extends Campaign
{
    /** @var PeriodStat */
    private $stats;

    /** @var PeriodStat */
    private $statsToday;

    /** @var PeriodStat */
    private $statsYesterday;

    /** @var PeriodStat[] */
    private $statsFull;

    /** @var \DateTime */
    private $lastStatsUpdated;

    public function load(DataAccess $data, DomainFactory $factory)
    {
        parent::load($data, $factory);

        $this->lastStatsUpdated = $data->peek('last_stats_updated')->map('MyTarget\dateFromString')->unwrap();
    }
}
