<?php

namespace Dsl\MyTarget\Domain\V1\Campaign;

use Dsl\MyTarget\Domain\V1\Enum\AutobiddingMode;
use Dsl\MyTarget\Domain\V1\Enum\Mixing;
use Dsl\MyTarget\Domain\V1\Enum\Status;
use Dsl\MyTarget\Domain\V1\Targeting\CampaignTargeting;
use Dsl\MyTarget\Mapper\Annotation\Field;
use Dsl\MyTarget as f;

class MutateCampaign
{
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
     * @var PackageId
     * @Field(type="Dsl\MyTarget\Domain\V1\Campaign\PackageId")
     */
    private $package;

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
     * @var AutobiddingMode
     * @Field(name="autobidding_mode", type="Dsl\MyTarget\Domain\V1\Enum\AutobiddingMode")
     */
    private $autoBiddingMode;

    /**
     * @var string
     * @Field(name="age_restrictions", type="string")
     */
    private $ageRestrictions;

    /**
     * @var RemarketingPricelistId
     * @Field(name="price_list", type="Dsl\MyTarget\Domain\V1\Campaign\RemarketingPricelistId")
     */
    private $pricelist;

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
     * @Field(name="audit_pixels", type="array<string>")
     */
    private $auditPixels;

    /**
     * @param string $name
     * @param PackageId $package
     * @param CampaignTargeting $targeting
     *
     * @return MutateCampaign
     */
    public static function forCreate($name, PackageId $package, CampaignTargeting $targeting)
    {
        $self = new MutateCampaign();
        $self->name = $name;
        $self->package = $package;
        $self->targetings = $targeting;

        return $self;
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
    public function setStatus(Status $status = null)
    {
        $this->status = $status;
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
    public function setDateStart(\DateTimeInterface $dateStart = null)
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
    public function setDateEnd(\DateTimeInterface $dateEnd = null)
    {
        $this->dateEnd = f\date_immutable($dateEnd);
    }

    /**
     * @return PackageId
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param PackageId $package
     */
    public function setPackage(PackageId $package = null)
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
    public function setMixing(Mixing $mixing = null)
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
    public function setTargetings(CampaignTargeting $targetings = null)
    {
        $this->targetings = $targetings;
    }

    /**
     * @return AutobiddingMode
     */
    public function getAutoBiddingMode()
    {
        return $this->autoBiddingMode;
    }

    /**
     * @param AutobiddingMode $autoBiddingMode
     */
    public function setAutoBiddingMode(AutobiddingMode $autoBiddingMode = null)
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
     * @return RemarketingPricelistId
     */
    public function getPricelist()
    {
        return $this->pricelist;
    }

    /**
     * @param RemarketingPricelistId $pricelist
     */
    public function setPricelist(RemarketingPricelistId $pricelist = null)
    {
        $this->pricelist = $pricelist;
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
     * @return string[]
     */
    public function getAuditPixels()
    {
        return $this->auditPixels;
    }

    /**
     * @param string[] $auditPixels
     */
    public function setAuditPixels(array $auditPixels = null)
    {
        $this->auditPixels = $auditPixels;
    }
}
