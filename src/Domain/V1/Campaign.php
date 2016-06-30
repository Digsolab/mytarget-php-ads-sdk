<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\Hydrated;
use MyTarget\Domain\V1\Enum\Mixing;
use MyTarget\Domain\V1\Enum\Status;
use MyTarget\Util\DataAccess\DataAccess;
use MyTarget\DomainFactory;

class Campaign extends Hydrated
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Status */
    private $status;

    /** @var Status */
    private $systemStatus;

    /** @var \DateTime */
    private $created;

    /** @var \DateTime */
    private $updated;

    /** @var \DateTime */
    private $dateStart;

    /** @var \DateTime */
    private $dateEnd;

    /** @var Package */
    private $package;

    /** @var string */
    private $pricePerShow;

    /** @var string */
    private $pricePerClick;

    /** @var string */
    private $budgetLimitDay;

    /** @var string */
    private $budgetLimit;

    /** @var string */
    private $crClicksLimit;

    /** @var string */
    private $crShowsLimit;

    /** @var Mixing */
    private $mixing;

    /** @var CampaignTargeting */
    private $targetings;

    /** @var string */
    private $url;

    /** @var string */
    private $editUrl;

    /** @var string */
    private $bannersUrl;

    /** @var int */
    private $bannersCount;

    /** @var string */
    private $groupMembers;

    /** @var string */
    private $autoBiddingMode;

    /** @var bool */
    private $appendUtm;

    /** @var string */
    private $ageRestrictions;

    /** @var RemarketingPriceList */
    private $priceList;

    /** @var Banner[] */
    private $banners;

    /** @var \DateTime */
    private $lastUpdated;

    /** @var bool */
    private $extendedAge;

    /** @var bool */
    private $enableRecombination;

    /** @var bool */
    private $enableUtm;

    /** @var string */
    private $utm;

    /** @var int */
    private $uniqShowsLimit;

    /** @var string */
    private $uniqShowsPeriod;

    /** @var int */
    private $bannerUniqShowsLimit;

    /** @var string[] */
    private $auditPixels;

    /** @var string */
    private $urlObjectId;

    public function load(DataAccess $data, DomainFactory $factory)
    {
        $this->package = $data->peek("package")->map($factory->factorize(Package::class))->unwrap();
        $this->targetings = $data->peek("targetings")->map($factory->factorize(CampaignTargeting::class))->unwrap();
        $this->banners = $data->peek("banners")->map($factory->factorize(Banner::class))->unwrap();

        $this->status = $data->peek("status")->map([Status::class, "fromValue"])->unwrap();
        $this->systemStatus = $data->peek("system_status")->map([Status::class, "fromValue"])->unwrap();
        $this->mixing = $data->peek("mixing")->map([Mixing::class, "fromValue"])->unwrap();
        $this->created = $data->peek("created")->map('MyTarget\dateFromString')->unwrap();
        $this->updated = $data->peek("updated")->map('MyTarget\dateFromString')->unwrap();
        $this->dateStart = $data->peek("date_start")->map('MyTarget\dateFromString')->unwrap();
        $this->dateEnd = $data->peek("date_end")->map('MyTarget\dateFromString')->unwrap();
        $this->lastUpdated = $data->peek("last_updated")->map('MyTarget\dateFromString')->unwrap();

        $this->id = $data->getOrNull("id");
        $this->name = $data->getOrNull("name");
        $this->pricePerShow = $data->getOrNull("price_per_show");
        $this->pricePerClick = $data->getOrNull("price_per_show");
        $this->budgetLimitDay = $data->getOrNull("budget_limit_day");
        $this->budgetLimit = $data->getOrNull("budget_limit");
        $this->crClicksLimit = $data->getOrNull("cr_clicks_limit");
        $this->crShowsLimit = $data->getOrNull("cr_shows_limit");
        $this->url = $data->getOrNull("url");
        $this->editUrl = $data->getOrNull("edit_url");
        $this->bannersUrl = $data->getOrNull("banners_url");
        $this->bannersCount = $data->getOrNull("banners_count");
        $this->groupMembers = $data->getOrNull("group_members");
        $this->autoBiddingMode = $data->getOrNull("auto_bidding_mode");
        $this->appendUtm = $data->getOrNull("append_utm");
        $this->ageRestrictions = $data->getOrNull("age_restrictions");
        $this->extendedAge = $data->getOrNull("extended_age");
        $this->enableRecombination = $data->getOrNull("enable_recombination");
        $this->enableUtm = $data->getOrNull("enable_utm");
        $this->utm = $data->getOrNull("utm");
        $this->uniqShowsLimit = $data->getOrNull("uniq_shows_limit");
        $this->uniqShowsPeriod = $data->getOrNull("uniq_shows_period");
        $this->bannerUniqShowsLimit = $data->getOrNull("banner_uniq_shows_limit");
        $this->auditPixels = $data->getOrNull("audit_pixels");
        $this->urlObjectId = $data->getOrNull("urlObjectId");
    }

    public function unload()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "status" => $this->status ? $this->status->getValue() : null,
            "system_status" => $this->systemStatus ? $this->systemStatus->getValue() : null,
            "price_per_show" => $this->pricePerShow,
            "price_per_click" => $this->pricePerClick,
            "budget_limit_day" => $this->budgetLimitDay,
            "budget_limit" => $this->budgetLimit,
            "cr_clicks_limit" => $this->crClicksLimit,
            "cr_shows_limit" => $this->crShowsLimit,
            "url" => $this->url,
            "edit_url" => $this->editUrl,
            "group_members" => $this->groupMembers,
            "auto_bidding_mode" => $this->autoBiddingMode,
            "append_utm" => $this->appendUtm,
            "age_restrictions" => $this->ageRestrictions,
            "extended_age" => $this->extendedAge,
            "enable_recombination" => $this->enableRecombination,
            "enable_utm" => $this->enableUtm,
            "utm" => $this->utm,
            "uniq_shows_limit" => $this->uniqShowsLimit,
            "uniq_shows_period" => $this->uniqShowsPeriod,
            "banner_uniq_shows_limit" => $this->bannerUniqShowsLimit,
            "audit_pixels" => $this->auditPixels,
            "url_object_id" => $this->urlObjectId,
            "mixing" => $this->mixing->getValue(),
            "date_start" => $this->dateStart ? \MyTarget\stringFromDate($this->dateStart) : null,
            "date_end" => $this->dateEnd ? \MyTarget\stringFromDate($this->dateEnd) : null,
            "package" => $this->package ? $this->package->unload() : null,
            "targetings" => $this->targetings ? $this->targetings->unload() : null
        ];
    }
}
