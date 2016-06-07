<?php

namespace MyTarget\Domain\V1;

class BannerStat
{
    /** @var Banner */
    private $banner;

    /** @var PeriodStat */
    private $stats;

    /** @var PeriodStat */
    private $statsToday;

    /** @var PeriodStat */
    private $statsYesterday;

    /** @var PeriodStat[] */
    private $statsFull;
}
