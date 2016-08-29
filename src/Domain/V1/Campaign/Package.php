<?php

namespace Dsl\MyTarget\Domain\V1\Campaign;

use Dsl\MyTarget\Domain\V1\Targeting\CampaignTargeting;
use Dsl\MyTarget\Mapper\Annotation\Field;
use Dsl\MyTarget\Domain\V1\Enum\Status;

class Package
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
     * @var Status
     * @Field(name="status", type="Dsl\MyTarget\Domain\V1\Enum\Status")
     */
    private $status;

    /**
     * @var Status
     * @Field(name="system_status", type="Dsl\MyTarget\Domain\V1\Enum\Status")
     */
    private $systemStatus;

    /**
     * @var string
     * @Field(name="description", type="string")
     */
    private $description;

    /**
     * @var string
     * @Field(name="price_per_show", type="string")
     */
    private $pricePerShow;

    /**
     * @var string
     * @Field(name="price_per_click", type="string")
     */
    private $pricePerClick;

    /**
     * @var string
     * @Field(name="max_price_per_unit", type="string")
     */
    private $maxPricePerUnit;

    /**
     * @var mixed
     * @Field(name="features", type="mixed")
     */
    private $features;

    /**
     * @var mixed
     * @Field(name="banner_format", type="mixed")
     */
    private $bannerFormat;

    /**
     * @var CampaignTargeting
     * @Field(name="targetings", type="Dsl\MyTarget\Domain\V1\Targeting\CampaignTargeting")
     */
    private $targetings;

    /**
     * @var string[]
     * @Field(name="flags", type="array<string>")
     */
    private $flags;

    /**
     * @var int
     * @Field(name="max_uniq_shows_limit", type="int")
     */
    private $maxUniqShowsLimit;

    /**
     * @var int
     * @Field(name="related_package_id", type="int")
     */
    private $relatedPackageId;

    /**
     * @var mixed
     * @Field(name="options", type="mixed")
     */
    private $options;

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

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
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return Status
     */
    public function getSystemStatus()
    {
        return $this->systemStatus;
    }

    /**
     * @param Status $systemStatus
     */
    public function setSystemStatus($systemStatus)
    {
        $this->systemStatus = $systemStatus;
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
    public function getPricePerShow()
    {
        return $this->pricePerShow;
    }

    /**
     * @param string $pricePerShow
     */
    public function setPricePerShow($pricePerShow)
    {
        $this->pricePerShow = $pricePerShow;
    }

    /**
     * @return string
     */
    public function getPricePerClick()
    {
        return $this->pricePerClick;
    }

    /**
     * @param string $pricePerClick
     */
    public function setPricePerClick($pricePerClick)
    {
        $this->pricePerClick = $pricePerClick;
    }

    /**
     * @return string
     */
    public function getMaxPricePerUnit()
    {
        return $this->maxPricePerUnit;
    }

    /**
     * @param string $maxPricePerUnit
     */
    public function setMaxPricePerUnit($maxPricePerUnit)
    {
        $this->maxPricePerUnit = $maxPricePerUnit;
    }

    /**
     * @return mixed
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param mixed $features
     */
    public function setFeatures($features)
    {
        $this->features = $features;
    }

    /**
     * @return string
     */
    public function getBannerFormat()
    {
        return $this->bannerFormat;
    }

    /**
     * @param string $bannerFormat
     */
    public function setBannerFormat($bannerFormat)
    {
        $this->bannerFormat = $bannerFormat;
    }

    /**
     * @return CampaignTargeting
     */
    public function getTargetings()
    {
        return $this->targetings;
    }

    /**
     * @param CampaignTargeting $targetings
     */
    public function setTargetings($targetings)
    {
        $this->targetings = $targetings;
    }

    /**
     * @return \string[]
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param \string[] $flags
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }

    /**
     * @return int
     */
    public function getMaxUniqShowsLimit()
    {
        return $this->maxUniqShowsLimit;
    }

    /**
     * @param int $maxUniqShowsLimit
     */
    public function setMaxUniqShowsLimit($maxUniqShowsLimit)
    {
        $this->maxUniqShowsLimit = $maxUniqShowsLimit;
    }

    /**
     * @return int
     */
    public function getRelatedPackageId()
    {
        return $this->relatedPackageId;
    }

    /**
     * @param int $relatedPackageId
     */
    public function setRelatedPackageId($relatedPackageId)
    {
        $this->relatedPackageId = $relatedPackageId;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}
