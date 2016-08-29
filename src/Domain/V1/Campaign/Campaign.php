<?php

namespace Dsl\MyTarget\Domain\V1\Campaign;

use Dsl\MyTarget\Domain\V1\Banner\Banner;
use Dsl\MyTarget\Domain\V1\Targeting\CampaignTargeting;
use Dsl\MyTarget\Domain\V1\Enum\Mixing;
use Dsl\MyTarget\Domain\V1\Enum\Status;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingPricelist;
use Dsl\MyTarget\Mapper\Annotation\Field;
use Dsl\MyTarget as f;

class Campaign
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var Status
     * @Field(type="Dsl\MyTarget\Domain\V1\Enum\Status")
     */
    private $status;

    /**
     * @var Status
     * @Field(name="system_status", type="Dsl\MyTarget\Domain\V1\Enum\Status")
     */
    private $systemStatus;

    /**
     * @var \DateTimeImmutable
     * @Field(type="DateTime")
     */
    private $created;

    /**
     * @var \DateTimeImmutable
     * @Field(type="DateTime")
     */
    private $updated;

    /**
     * @var \DateTimeImmutable
     * @Field(name="date_start", type="DateTime<d.m.Y>")
     */
    private $dateStart;

    /**
     * @var \DateTimeImmutable
     * @Field(name="date_end", type="DateTime<d.m.Y>")
     */
    private $dateEnd;

    /**
     * @var Package
     * @Field(type="Dsl\MyTarget\Domain\V1\Campaign\Package")
     */
    private $package;

    /**
     * @var string
     * @Field(name="price_per_show", type="string")
     */
    private $pricePerShow;

    /**
     * @Field(name="price_per_click", type="string")
     */
    private $pricePerClick;

    /**
     * @var string
     * @Field(name="budget_limit_day", type="string")
     */
    private $budgetLimitDay;

    /**
     * @var string
     * @Field(name="budget_limit", type="string")
     */
    private $budgetLimit;

    /**
     * @var string
     * @Field(name="cr_clicks_limit", type="string")
     */
    private $crClicksLimit;

    /**
     * @var string
     * @Field(name="cr_shows_limit", type="string")
     */
    private $crShowsLimit;

    /**
     * @var Mixing
     * @Field(name="mixing", type="Dsl\MyTarget\Domain\V1\Enum\Mixing")
     */
    private $mixing;

    /**
     * @var CampaignTargeting
     * @Field(name="targetings", type="Dsl\MyTarget\Domain\V1\Targeting\CampaignTargeting")
     */
    private $targetings;

    /**
     * @var string
     * @Field(name="url", type="string")
     */
    private $url;

    /**
     * @var string
     * @Field(name="edit_url", type="string")
     */
    private $editUrl;

    /**
     * @var string
     * @Field(name="banners_url", type="string")
     */
    private $bannersUrl;

    /**
     * @var int
     * @Field(name="banners_count", type="int")
     */
    private $bannersCount;

    /**
     * @var string
     * @Field(name="group_members", type="string")
     */
    private $groupMembers;

    /**
     * @var string
     * @Field(name="auto_bidding_mode", type="Dsl\MyTarget\Domain\V1\Enum\AutobiddingMode")
     */
    private $autoBiddingMode;

    /**
     * @var string
     * @Field(name="age_restrictions", type="string")
     */
    private $ageRestrictions;

    /**
     * @var RemarketingPricelist
     * @Field(name="price_list", type="Dsl\MyTarget\Domain\V1\Remarketing\RemarketingPricelist")
     */
    private $pricelist;

    /**
     * @var Banner[]
     * @Field(name="banners", type="array<Dsl\MyTarget\Domain\V1\Banner\Banner>")
     */
    private $banners;

    /**
     * @var \DateTimeImmutable
     * @Field(name="last_updated", type="DateTime")
     */
    private $lastUpdated;

    /**
     * @var bool
     * @Field(name="extended_age", type="bool")
     */
    private $extendedAge;

    /**
     * @var bool
     * @Field(name="enable_recombination", type="bool")
     */
    private $enableRecombination;

    /**
     * @var bool
     * @Field(name="enable_utm", type="bool")
     */
    private $enableUtm;

    /**
     * @var string
     * @Field(name="utm", type="string")
     */
    private $utm;

    /**
     * @var int
     * @Field(name="uniq_shows_limit", type="int")
     */
    private $uniqShowsLimit;

    /**
     * @var string
     * @Field(name="uniq_shows_period", type="string")
     */
    private $uniqShowsPeriod;

    /**
     * @var int
     * @Field(name="banner_uniq_shows_limit", type="int")
     */
    private $bannerUniqShowsLimit;

    /**
     * @var string[]
     * @Field(name="audit_pixels", type="dict<string>")
     */
    private $auditPixels;

    /**
     * @var string
     * @Field(name="url_object_id", type="string")
     */
    private $urlObjectId;

    /**
     * @param string $name
     * @param Package $package
     * @param CampaignTargeting $targetings
     */
    public function __construct($name, Package $package, CampaignTargeting $targetings)
    {
        $this->name = $name;
        $this->package = $package;
        $this->targetings = $targetings;
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
     * @return \DateTimeImmutable
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTimeInterface $created
     */
    public function setCreated(\DateTimeInterface $created)
    {
        $this->created = f\date_immutable($created);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTimeInterface $updated
     */
    public function setUpdated(\DateTimeInterface $updated)
    {
        $this->updated = f\date_immutable($updated);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param \DateTimeInterface $dateStart
     */
    public function setDateStart(\DateTimeInterface $dateStart)
    {
        $this->dateStart = f\date_immutable($dateStart);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTimeInterface $dateEnd
     */
    public function setDateEnd(\DateTimeInterface $dateEnd)
    {
        $this->dateEnd = f\date_immutable($dateEnd);
    }

    /**
     * @return Package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param Package $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
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
     * @return mixed
     */
    public function getPricePerClick()
    {
        return $this->pricePerClick;
    }

    /**
     * @param mixed $pricePerClick
     */
    public function setPricePerClick($pricePerClick)
    {
        $this->pricePerClick = $pricePerClick;
    }

    /**
     * @return string
     */
    public function getBudgetLimitDay()
    {
        return $this->budgetLimitDay;
    }

    /**
     * @param string $budgetLimitDay
     */
    public function setBudgetLimitDay($budgetLimitDay)
    {
        $this->budgetLimitDay = $budgetLimitDay;
    }

    /**
     * @return string
     */
    public function getBudgetLimit()
    {
        return $this->budgetLimit;
    }

    /**
     * @param string $budgetLimit
     */
    public function setBudgetLimit($budgetLimit)
    {
        $this->budgetLimit = $budgetLimit;
    }

    /**
     * @return string
     */
    public function getCrClicksLimit()
    {
        return $this->crClicksLimit;
    }

    /**
     * @param string $crClicksLimit
     */
    public function setCrClicksLimit($crClicksLimit)
    {
        $this->crClicksLimit = $crClicksLimit;
    }

    /**
     * @return string
     */
    public function getCrShowsLimit()
    {
        return $this->crShowsLimit;
    }

    /**
     * @param string $crShowsLimit
     */
    public function setCrShowsLimit($crShowsLimit)
    {
        $this->crShowsLimit = $crShowsLimit;
    }

    /**
     * @return Mixing
     */
    public function getMixing()
    {
        return $this->mixing;
    }

    /**
     * @param Mixing $mixing
     */
    public function setMixing($mixing)
    {
        $this->mixing = $mixing;
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
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getEditUrl()
    {
        return $this->editUrl;
    }

    /**
     * @param string $editUrl
     */
    public function setEditUrl($editUrl)
    {
        $this->editUrl = $editUrl;
    }

    /**
     * @return string
     */
    public function getBannersUrl()
    {
        return $this->bannersUrl;
    }

    /**
     * @param string $bannersUrl
     */
    public function setBannersUrl($bannersUrl)
    {
        $this->bannersUrl = $bannersUrl;
    }

    /**
     * @return int
     */
    public function getBannersCount()
    {
        return $this->bannersCount;
    }

    /**
     * @param int $bannersCount
     */
    public function setBannersCount($bannersCount)
    {
        $this->bannersCount = $bannersCount;
    }

    /**
     * @return string
     */
    public function getGroupMembers()
    {
        return $this->groupMembers;
    }

    /**
     * @param string $groupMembers
     */
    public function setGroupMembers($groupMembers)
    {
        $this->groupMembers = $groupMembers;
    }

    /**
     * @return string
     */
    public function getAutoBiddingMode()
    {
        return $this->autoBiddingMode;
    }

    /**
     * @param string $autoBiddingMode
     */
    public function setAutoBiddingMode($autoBiddingMode)
    {
        $this->autoBiddingMode = $autoBiddingMode;
    }

    /**
     * @return string
     */
    public function getAgeRestrictions()
    {
        return $this->ageRestrictions;
    }

    /**
     * @param string $ageRestrictions
     */
    public function setAgeRestrictions($ageRestrictions)
    {
        $this->ageRestrictions = $ageRestrictions;
    }

    /**
     * @return RemarketingPriceList
     */
    public function getPricelist()
    {
        return $this->pricelist;
    }

    /**
     * @param RemarketingPriceList $pricelist
     */
    public function setPricelist($pricelist)
    {
        $this->pricelist = $pricelist;
    }

    /**
     * @return Banner[]
     */
    public function getBanners()
    {
        return $this->banners;
    }

    /**
     * @param Banner[] $banners
     */
    public function setBanners($banners)
    {
        $this->banners = $banners;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @param \DateTimeInterface $lastUpdated
     */
    public function setLastUpdated(\DateTimeInterface $lastUpdated)
    {
        $this->lastUpdated = f\date_immutable($lastUpdated);
    }

    /**
     * @return bool
     */
    public function isExtendedAge()
    {
        return $this->extendedAge;
    }

    /**
     * @param bool $extendedAge
     */
    public function setExtendedAge($extendedAge)
    {
        $this->extendedAge = $extendedAge;
    }

    /**
     * @return bool
     */
    public function isEnableRecombination()
    {
        return $this->enableRecombination;
    }

    /**
     * @param bool $enableRecombination
     */
    public function setEnableRecombination($enableRecombination)
    {
        $this->enableRecombination = $enableRecombination;
    }

    /**
     * @return bool
     */
    public function isEnableUtm()
    {
        return $this->enableUtm;
    }

    /**
     * @param bool $enableUtm
     */
    public function setEnableUtm($enableUtm)
    {
        $this->enableUtm = $enableUtm;
    }

    /**
     * @return string
     */
    public function getUtm()
    {
        return $this->utm;
    }

    /**
     * @param string $utm
     */
    public function setUtm($utm)
    {
        $this->utm = $utm;
    }

    /**
     * @return int
     */
    public function getUniqShowsLimit()
    {
        return $this->uniqShowsLimit;
    }

    /**
     * @param int $uniqShowsLimit
     */
    public function setUniqShowsLimit($uniqShowsLimit)
    {
        $this->uniqShowsLimit = $uniqShowsLimit;
    }

    /**
     * @return string
     */
    public function getUniqShowsPeriod()
    {
        return $this->uniqShowsPeriod;
    }

    /**
     * @param string $uniqShowsPeriod
     */
    public function setUniqShowsPeriod($uniqShowsPeriod)
    {
        $this->uniqShowsPeriod = $uniqShowsPeriod;
    }

    /**
     * @return int
     */
    public function getBannerUniqShowsLimit()
    {
        return $this->bannerUniqShowsLimit;
    }

    /**
     * @param int $bannerUniqShowsLimit
     */
    public function setBannerUniqShowsLimit($bannerUniqShowsLimit)
    {
        $this->bannerUniqShowsLimit = $bannerUniqShowsLimit;
    }

    /**
     * @return \string[]
     */
    public function getAuditPixels()
    {
        return $this->auditPixels;
    }

    /**
     * @param \string[] $auditPixels
     */
    public function setAuditPixels($auditPixels)
    {
        $this->auditPixels = $auditPixels;
    }

    /**
     * @return string
     */
    public function getUrlObjectId()
    {
        return $this->urlObjectId;
    }

    /**
     * @param string $urlObjectId
     */
    public function setUrlObjectId($urlObjectId)
    {
        $this->urlObjectId = $urlObjectId;
    }
}
