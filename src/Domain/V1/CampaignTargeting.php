<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;
use MyTarget\Domain\V1\Enum\MobilePrefix;
use MyTarget\Domain\V1\Enum\MobileType;
use MyTarget\Domain\V1\Enum\Sex;
use MyTarget\Domain\V1\Pad\Pad;

class CampaignTargeting
{
    /**
     * @var Pad[]
     * @Field(name="pads", type="array<MyTarget\Domain\V1\Pad\Pad>")
     */
    private $pads;

    /**
     * @var RemarketingTargeting[]
     * @Field(name="remarketing", type="array<MyTarget\Domain\V1\RemarketingTargeting>")
     */
    private $remarketing;

    /**
     * @var int[]
     * @Field(name="age", type="array<int>")
     */
    private $age;

    /**
     * @var int[]
     * @Field(name="regions", type="array<int>")
     */
    private $regions;

    /**
     * @var Sex
     * @Field(name="sex", type="MyTarget\Domain\V1\Enum\Sex")
     */
    private $sex;

    /**
     * @var Fulltime
     * @Field(name="fulltime", type="MyTarget\Domain\V1\Fulltime")
     */
    private $fulltime;

    /**
     * @var string[]
     * @Field(name="education", type="array<string>")
     */
    private $education;

    /**
     * @var string[]
     * @Field(name="salary", type="array<string>")
     */
    private $salary;

    /**
     * @var string
     * @Field(name="profession", type="string")
     */
    private $profession;

    /**
     * @var Language
     * @Field(name="language", type="MyTarget\Domain\V1\Language")
     */
    private $language;

    /**
     * @var Birthday
     * @Field(name="birthday", type="MyTarget\Domain\V1\Birthday")
     */
    private $birthday;

    /**
     * @var mixed
     * @Field(name="user_geo", type="mixed")
     */
    private $userGeo;

    /**
     * @var LocalGeo
     * @Field(name="local_geo", type="MyTarget\Domain\V1\LocalGeo")
     */
    private $localGeo;

    /**
     * @var AppRecommendation
     * @Field(name="app_recommendation", type="MyTarget\Domain\V1\AppRecommendation")
     */
    private $appRecommendation;

    /**
     * @var MobileType[]
     * @Field(name="mobile_types", type="array<MyTarget\Domain\V1\Enum\MobileType>")
     */
    private $mobileTypes;

    /**
     * @var MobilePrefix[]
     * @Field(name="mobile_prefix", type="array<MyTarget\Domain\V1\Enum\MobilePrefix>")
     */
    private $mobilePrefix;

    /**
     * @var int[]
     * @Field(name="mobile_operating_systems", type="array<int>")
     */
    private $mobileOperatingSystems;

    /**
     * @var int[]
     * @Field(name="mobile_operators", type="array<int>")
     */
    private $mobileOperators;

    /**
     * @var int[]
     * @Field(name="mobile_vendors", type="array<int>")
     */
    private $mobileVendors;

    /**
     * @var mixed
     * @Field(name="mobile_apps", type="mixed")
     */
    private $mobileApps;

    /**
     * @var int[]
     * @Field(name="interests", type="array<int>")
     */
    private $interests;

    /**
     * @return Pad[]
     */
    public function getPads()
    {
        return $this->pads;
    }

    /**
     * @param Pad[] $pads
     */
    public function setPads($pads)
    {
        $this->pads = $pads;
    }

    /**
     * @return RemarketingTargeting[]
     */
    public function getRemarketing()
    {
        return $this->remarketing;
    }

    /**
     * @param RemarketingTargeting[] $remarketing
     */
    public function setRemarketing($remarketing)
    {
        $this->remarketing = $remarketing;
    }

    /**
     * @return \int[]
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param \int[] $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return \int[]
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * @param \int[] $regions
     */
    public function setRegions($regions)
    {
        $this->regions = $regions;
    }

    /**
     * @return Sex
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param Sex $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return Fulltime
     */
    public function getFulltime()
    {
        return $this->fulltime;
    }

    /**
     * @param Fulltime $fulltime
     */
    public function setFulltime($fulltime)
    {
        $this->fulltime = $fulltime;
    }

    /**
     * @return \string[]
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param \string[] $education
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    /**
     * @return \string[]
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param \string[] $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param string $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param Language $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return Birthday
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param Birthday $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getUserGeo()
    {
        return $this->userGeo;
    }

    /**
     * @param mixed $userGeo
     */
    public function setUserGeo($userGeo)
    {
        $this->userGeo = $userGeo;
    }

    /**
     * @return LocalGeo
     */
    public function getLocalGeo()
    {
        return $this->localGeo;
    }

    /**
     * @param LocalGeo $localGeo
     */
    public function setLocalGeo($localGeo)
    {
        $this->localGeo = $localGeo;
    }

    /**
     * @return AppRecommendation
     */
    public function getAppRecommendation()
    {
        return $this->appRecommendation;
    }

    /**
     * @param AppRecommendation $appRecommendation
     */
    public function setAppRecommendation($appRecommendation)
    {
        $this->appRecommendation = $appRecommendation;
    }

    /**
     * @return Enum\MobileType[]
     */
    public function getMobileTypes()
    {
        return $this->mobileTypes;
    }

    /**
     * @param Enum\MobileType[] $mobileTypes
     */
    public function setMobileTypes($mobileTypes)
    {
        $this->mobileTypes = $mobileTypes;
    }

    /**
     * @return Enum\MobilePrefix[]
     */
    public function getMobilePrefix()
    {
        return $this->mobilePrefix;
    }

    /**
     * @param Enum\MobilePrefix[] $mobilePrefix
     */
    public function setMobilePrefix($mobilePrefix)
    {
        $this->mobilePrefix = $mobilePrefix;
    }

    /**
     * @return \int[]
     */
    public function getMobileOperatingSystems()
    {
        return $this->mobileOperatingSystems;
    }

    /**
     * @param \int[] $mobileOperatingSystems
     */
    public function setMobileOperatingSystems($mobileOperatingSystems)
    {
        $this->mobileOperatingSystems = $mobileOperatingSystems;
    }

    /**
     * @return \int[]
     */
    public function getMobileOperators()
    {
        return $this->mobileOperators;
    }

    /**
     * @param \int[] $mobileOperators
     */
    public function setMobileOperators($mobileOperators)
    {
        $this->mobileOperators = $mobileOperators;
    }

    /**
     * @return \int[]
     */
    public function getMobileVendors()
    {
        return $this->mobileVendors;
    }

    /**
     * @param \int[] $mobileVendors
     */
    public function setMobileVendors($mobileVendors)
    {
        $this->mobileVendors = $mobileVendors;
    }

    /**
     * @return mixed
     */
    public function getMobileApps()
    {
        return $this->mobileApps;
    }

    /**
     * @param mixed $mobileApps
     */
    public function setMobileApps($mobileApps)
    {
        $this->mobileApps = $mobileApps;
    }

    /**
     * @return \int[]
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * @param \int[] $interests
     */
    public function setInterests($interests)
    {
        $this->interests = $interests;
    }
}
