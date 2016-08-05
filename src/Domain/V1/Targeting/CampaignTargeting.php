<?php

namespace Dsl\MyTarget\Domain\V1\Targeting;

use Dsl\MyTarget\Domain\V1\Enum;
use Dsl\MyTarget\Mapper\Annotation\Field;
use Dsl\MyTarget\Domain\V1\Enum\MobilePrefix;
use Dsl\MyTarget\Domain\V1\Enum\MobileType;
use Dsl\MyTarget\Domain\V1\Enum\Sex;
use Dsl\MyTarget\Domain\V1\Targeting\Pad\Pad;
use Dsl\MyTarget\Domain\V1\Enum\Employment;

class CampaignTargeting
{
    /**
     * @var Pad[]
     * @Field(name="pads", type="array<Dsl\MyTarget\Domain\V1\Targeting\Pad\Pad>")
     */
    private $pads;

    /**
     * @var RemarketingTargeting[]
     * @Field(name="remarketing", type="array<Dsl\MyTarget\Domain\V1\Targeting\RemarketingTargeting>")
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
     * @Field(name="sex", type="Dsl\MyTarget\Domain\V1\Enum\Sex")
     */
    private $sex;

    /**
     * @var Employment[]
     * @Field(type="array<Dsl\MyTarget\Domain\V1\Enum\Employment>")
     */
    private $employment;

    /**
     * @var Enum\PersonalIncome[]
     * @Field(name="personal_income", type="array<Dsl\MyTarget\Domain\V1\Enum\PersonalIncome>")
     */
    private $personalIncome;

    /**
     * @var Enum\MaritalStatus[]
     * @Field(name="marital_status", type="array<Dsl\MyTarget\Domain\V1\Enum\MaritalStatus>")
     */
    private $maritalStatus;

    /**
     * @var Enum\TvType[]
     * @Field(name="tv_viewer", type="array<Dsl\MyTarget\Domain\V1\Enum\TvType>")
     */
    private $tvViewer;

    /**
     * @var int[]
     * @Field(type="array<int>")
     */
    private $hours;

    /**
     * @var Fulltime
     * @Field(name="fulltime", type="Dsl\MyTarget\Domain\V1\Targeting\Fulltime")
     */
    private $fulltime;

    /**
     * @var Enum\Education[]
     * @Field(name="f_education", type="array<Dsl\MyTarget\Domain\V1\Enum\TvType>")
     */
    private $education;

    /**
     * @var string[]
     * @Field(name="salary", type="array<string>")
     */
    private $salary;

    /**
     * @var string[]
     * @Field(name="profession", type="array<string>")
     */
    private $profession;

    /**
     * @var Language
     * @Field(name="language", type="Dsl\MyTarget\Domain\V1\Targeting\Language")
     */
    private $language;

    /**
     * @var Birthday
     * @Field(name="birthday", type="Dsl\MyTarget\Domain\V1\Targeting\Birthday")
     */
    private $birthday;

    /**
     * @var array
     * @Field(name="user_geo", type="dict")
     */
    private $userGeo;

    /**
     * @var LocalGeo
     * @Field(name="local_geo", type="Dsl\MyTarget\Domain\V1\Targeting\LocalGeo")
     */
    private $localGeo;

    /**
     * @var AppRecommendation
     * @Field(name="app_recommendation", type="Dsl\MyTarget\Domain\V1\Targeting\AppRecommendation")
     */
    private $appRecommendation;

    /**
     * @var MobileType[]
     * @Field(name="mobile_types", type="array<Dsl\MyTarget\Domain\V1\Enum\MobileType>")
     */
    private $mobileTypes;

    /**
     * @var MobilePrefix[]
     * @Field(name="mobile_prefix", type="array<Dsl\MyTarget\Domain\V1\Enum\MobilePrefix>")
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
     * @return int[]
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int[] $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return int[]
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * @param int[] $regions
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
     * @return Enum\Education[]
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param Enum\Education[] $education
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    /**
     * @return string[]
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param string[] $salary
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
     * @return array
     */
    public function getUserGeo()
    {
        return $this->userGeo;
    }

    /**
     * @param array $userGeo
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
     * @return int[]
     */
    public function getMobileOperatingSystems()
    {
        return $this->mobileOperatingSystems;
    }

    /**
     * @param int[] $mobileOperatingSystems
     */
    public function setMobileOperatingSystems($mobileOperatingSystems)
    {
        $this->mobileOperatingSystems = $mobileOperatingSystems;
    }

    /**
     * @return int[]
     */
    public function getMobileOperators()
    {
        return $this->mobileOperators;
    }

    /**
     * @param int[] $mobileOperators
     */
    public function setMobileOperators($mobileOperators)
    {
        $this->mobileOperators = $mobileOperators;
    }

    /**
     * @return int[]
     */
    public function getMobileVendors()
    {
        return $this->mobileVendors;
    }

    /**
     * @param int[] $mobileVendors
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
     * @return int[]
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * @param int[] $interests
     */
    public function setInterests($interests)
    {
        $this->interests = $interests;
    }

    /**
     * @return Enum\Employment[]
     */
    public function getEmployment()
    {
        return $this->employment;
    }

    /**
     * @param Enum\Employment[] $employment
     */
    public function setEmployment($employment)
    {
        $this->employment = $employment;
    }

    /**
     * @return Enum\PersonalIncome[]
     */
    public function getPersonalIncome()
    {
        return $this->personalIncome;
    }

    /**
     * @param Enum\PersonalIncome[] $personalIncome
     */
    public function setPersonalIncome($personalIncome)
    {
        $this->personalIncome = $personalIncome;
    }

    /**
     * @return Enum\MaritalStatus[]
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param Enum\MaritalStatus[] $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return Enum\TvType[]
     */
    public function getTvViewer()
    {
        return $this->tvViewer;
    }

    /**
     * @param Enum\TvType[] $tvViewer
     */
    public function setTvViewer($tvViewer)
    {
        $this->tvViewer = $tvViewer;
    }

    /**
     * @return int[]
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param int[] $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }
}
