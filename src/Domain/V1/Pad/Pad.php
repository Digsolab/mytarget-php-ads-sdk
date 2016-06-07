<?php

namespace MyTarget\Domain\V1\Pad;

use MyTarget\Domain\V1\PeriodStat;

class Pad
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var string */
    private $iconUrl;

    /** @var int */
    private $slotId;

    /** @var string */
    private $status;

    /** @var bool */
    private $showSelfApps;

    /** @var bool */
    private $showForeignApps;

    /** @var PadGroup */
    private $padGroup;

    /** @var EyeUrl */
    private $eyeUrl;

    /** @var int */
    private $formatId;

    /** @var string */
    private $padMd5;

    /** @var PeriodStat */
    private $stats;

    /** @var PeriodStat */
    private $statsToday;

    /** @var PeriodStat */
    private $statsYesterday;

    /** @var string */
    private $codeBlock;

    /** @var int */
    private $blockCpmLimit;
}
