<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\Hydrated;
use MyTarget\Domain\V1\Enum\MobilePrefix;
use MyTarget\Domain\V1\Enum\MobileType;
use MyTarget\Domain\V1\Enum\Sex;
use MyTarget\Domain\V1\Pad\Pad;
use MyTarget\DomainFactory;
use MyTarget\Util\DataAccess\DataAccess;

class CampaignTargeting extends Hydrated
{
    /** @var Pad[] */
    private $pads;

    /** @var RemarketingTargeting[] */
    private $remarketing;

    /** @var int[] */
    private $age;

    /** @var int[] */
    private $regions;

    /** @var Sex */
    private $sex;

    /** @var Fulltime */
    private $fulltime;

    /** @var string[] */
    private $education;

    /** @var string[] */
    private $salary;

    /** @var string */
    private $profession;

    /** @var Language */
    private $language;

    /** @var Birthday */
    private $birthday;

    /** @var mixed */
    private $userGeo;

    /** @var LocalGeo */
    private $localGeo;

    /** @var AppRecommendation */
    private $appRecommendation;

    /** @var MobileType[] */
    private $mobileTypes;

    /** @var MobilePrefix[] */
    private $mobilePrefix;

    /** @var int[] */
    private $mobileOperatingSystems;

    /** @var int[] */
    private $mobileOperators;

    /** @var int[] */
    private $mobileVendors;

    /** @var mixed */
    private $mobileApps;

    /** @var int[] */
    private $interests;

    public function load(DataAccess $data, DomainFactory $factory)
    {
        /*
         * Too much boilerplate code, validation of target responses will have to be handled independently
         * which leads to duplication of keys from response maps.
         *
         * Might be better to use annotations for hydration and validation
         * (in this case validation is type verification so it's pretty easy)...
         */

        $this->pads = $data->peek("pads")->map(\MyTarget\applyToAll($factory->factorize(Pad::class)))->unwrap();
        $this->remarketing = $data->peek("remarketing")
            ->map(\MyTarget\applyToAll($factory->factorize(RemarketingTargeting::class)))->unwrap();
        $this->fulltime = $data->peek("fulltime")->map($factory->factorize(Fulltime::class))->unwrap();

        $this->age = $data->getOrNull("age");
        $this->regions = $data->getOrNull("regions");
        $this->sex = $data->peek("sex")->map([Sex::class, "fromValue"])->unwrap();
        $this->education = $data->getOrNull("education");
        $this->salary = $data->getOrNull("salary");
    }

    public function unload()
    {

    }
}
