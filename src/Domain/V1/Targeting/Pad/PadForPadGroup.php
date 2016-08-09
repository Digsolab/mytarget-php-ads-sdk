<?php

namespace Dsl\MyTarget\Domain\V1\Targeting\Pad;


use Dsl\MyTarget\Mapper\Annotation\Field;

class PadForPadGroup
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="description", type="string")
     */
    private $description;

    /**
     * @var string
     * @Field(name="status", type="string")
     */
    private $status;

    /**
     * @var int
     * @Field(name="format_id", type="int")
     */
    private $formatId;

    /**
     * @var int
     * @Field(name="shows_limit", type="int")
     */
    private $showsLimit;

    /**
     * @var string
     * @Field(name="shows_period", type="string")
     */
    private $showsPeriod;

    /**
     * @var int
     * @Field(name="shows_interval", type="int")
     */
    private $showsInterval;

    /**
     * @var PadFilter
     * @Field(name="filters", type="Dsl\MyTarget\Domain\V1\Targeting\Pad\PadFilter")
     */
    private $filters;

    /**
     * @var int
     * @Field(name="block_cpm_limit", type="int")
     */
    private $blockCpmLimit;

    /**
     * @var bool
     * @Field(name="js_tag", type="bool")
     */
    private $jsTag;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getFormatId()
    {
        return $this->formatId;
    }

    /**
     * @return int
     */
    public function getShowsLimit()
    {
        return $this->showsLimit;
    }

    /**
     * @return string
     */
    public function getShowsPeriod()
    {
        return $this->showsPeriod;
    }

    /**
     * @return int
     */
    public function getShowsInterval()
    {
        return $this->showsInterval;
    }

    /**
     * @return PadFilter
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return int
     */
    public function getBlockCpmLimit()
    {
        return $this->blockCpmLimit;
    }

    /**
     * @return bool
     */
    public function isJsTag()
    {
        return $this->jsTag;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param int $formatId
     */
    public function setFormatId($formatId)
    {
        $this->formatId = $formatId;
    }

    /**
     * @param int $showsLimit
     */
    public function setShowsLimit($showsLimit)
    {
        $this->showsLimit = $showsLimit;
    }

    /**
     * @param string $showsPeriod
     */
    public function setShowsPeriod($showsPeriod)
    {
        $this->showsPeriod = $showsPeriod;
    }

    /**
     * @param int $showsInterval
     */
    public function setShowsInterval($showsInterval)
    {
        $this->showsInterval = $showsInterval;
    }

    /**
     * @param \Dsl\MyTarget\Domain\V1\Targeting\Pad\PadFilter $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    /**
     * @param int $blockCpmLimit
     */
    public function setBlockCpmLimit($blockCpmLimit)
    {
        $this->blockCpmLimit = $blockCpmLimit;
    }

    /**
     * @param bool $jsTag
     */
    public function setJsTag($jsTag)
    {
        $this->jsTag = $jsTag;
    }
}
