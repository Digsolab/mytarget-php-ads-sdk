<?php

namespace MyTarget\Domain\V1\Targeting\Pad;

use MyTarget\Mapper\Annotation\Field;
use MyTarget\Domain\V1\PeriodStat;

class Pad
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     * @Field(name="description", type="string")
     */
    private $description;

    /**
     * @var string
     * @Field(name="icon_url", type="string")
     */
    private $iconUrl;

    /**
     * @var int
     * @Field(name="slot_id", type="int")
     */
    private $slotId;

    /**
     * @var string
     * @Field(name="status", type="string")
     */
    private $status;

    /**
     * @var bool
     * @Field(name="show_self_apps", type="bool")
     */
    private $showSelfApps;

    /**
     * @var bool
     * @Field(name="show_foreign_apps", type="bool")
     */
    private $showForeignApps;

    /**
     * @var PadGroup
     * @Field(name="pad_group", type="MyTarget\Domain\V1\Targeting\Pad\PadGroup")
     */
    private $padGroup;

    /**
     * @var EyeUrl
     * @Field(name="eye_url", type="MyTarget\Domain\V1\Targeting\Pad\EyeUrl")
     */
    private $eyeUrl;

    /**
     * @var int
     * @Field(name="format_id", type="int")
     */
    private $formatId;

    /**
     * @var string
     * @Field(name="pad_md5", type="string")
     */
    private $padMd5;

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
     * @var string
     * @Field(name="code_block", type="string")
     */
    private $codeBlock;

    /**
     * @var int
     * @Field(name="block_cpm_limit", type="int")
     */
    private $blockCpmLimit;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getIconUrl()
    {
        return $this->iconUrl;
    }

    /**
     * @param string $iconUrl
     */
    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;
    }

    /**
     * @return int
     */
    public function getSlotId()
    {
        return $this->slotId;
    }

    /**
     * @param int $slotId
     */
    public function setSlotId($slotId)
    {
        $this->slotId = $slotId;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isShowSelfApps()
    {
        return $this->showSelfApps;
    }

    /**
     * @param bool $showSelfApps
     */
    public function setShowSelfApps($showSelfApps)
    {
        $this->showSelfApps = $showSelfApps;
    }

    /**
     * @return bool
     */
    public function isShowForeignApps()
    {
        return $this->showForeignApps;
    }

    /**
     * @param bool $showForeignApps
     */
    public function setShowForeignApps($showForeignApps)
    {
        $this->showForeignApps = $showForeignApps;
    }

    /**
     * @return PadGroup
     */
    public function getPadGroup()
    {
        return $this->padGroup;
    }

    /**
     * @param PadGroup $padGroup
     */
    public function setPadGroup($padGroup)
    {
        $this->padGroup = $padGroup;
    }

    /**
     * @return EyeUrl
     */
    public function getEyeUrl()
    {
        return $this->eyeUrl;
    }

    /**
     * @param EyeUrl $eyeUrl
     */
    public function setEyeUrl($eyeUrl)
    {
        $this->eyeUrl = $eyeUrl;
    }

    /**
     * @return int
     */
    public function getFormatId()
    {
        return $this->formatId;
    }

    /**
     * @param int $formatId
     */
    public function setFormatId($formatId)
    {
        $this->formatId = $formatId;
    }

    /**
     * @return string
     */
    public function getPadMd5()
    {
        return $this->padMd5;
    }

    /**
     * @param string $padMd5
     */
    public function setPadMd5($padMd5)
    {
        $this->padMd5 = $padMd5;
    }

    /**
     * @return PeriodStat
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param PeriodStat $stats
     */
    public function setStats($stats)
    {
        $this->stats = $stats;
    }

    /**
     * @return PeriodStat
     */
    public function getStatsToday()
    {
        return $this->statsToday;
    }

    /**
     * @param PeriodStat $statsToday
     */
    public function setStatsToday($statsToday)
    {
        $this->statsToday = $statsToday;
    }

    /**
     * @return PeriodStat
     */
    public function getStatsYesterday()
    {
        return $this->statsYesterday;
    }

    /**
     * @param PeriodStat $statsYesterday
     */
    public function setStatsYesterday($statsYesterday)
    {
        $this->statsYesterday = $statsYesterday;
    }

    /**
     * @return string
     */
    public function getCodeBlock()
    {
        return $this->codeBlock;
    }

    /**
     * @param string $codeBlock
     */
    public function setCodeBlock($codeBlock)
    {
        $this->codeBlock = $codeBlock;
    }

    /**
     * @return int
     */
    public function getBlockCpmLimit()
    {
        return $this->blockCpmLimit;
    }

    /**
     * @param int $blockCpmLimit
     */
    public function setBlockCpmLimit($blockCpmLimit)
    {
        $this->blockCpmLimit = $blockCpmLimit;
    }
}
