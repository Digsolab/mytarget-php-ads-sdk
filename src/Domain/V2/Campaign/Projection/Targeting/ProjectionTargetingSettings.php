<?php
namespace Dsl\MyTarget\Domain\V2\Campaign\Projection\Targeting;

use Dsl\MyTarget\Domain\V1\Enum\Education;
use Dsl\MyTarget\Domain\V1\Enum\Employment;
use Dsl\MyTarget\Domain\V1\Enum\MobileType;
use Dsl\MyTarget\Domain\V1\Enum as V1Enum;
use Dsl\MyTarget\Domain\V1\Targeting\Fulltime;
use Dsl\MyTarget\Domain\V1\Targeting\Pad\Pad;
use Dsl\MyTarget\Domain\V1\Targeting\RemarketingTargeting;
use Dsl\MyTarget\Domain\V2\Enum\Sex;
use Dsl\MyTarget\Mapper\Annotation\Field;

class ProjectionTargetingSettings
{
    /**
     * @var int[]
     * @Field(name="age", type="array<int>")
     */
    private $age;

    /**
     * @var Sex[]
     * @Field(name="sex", type="Dsl\MyTarget\Domain\V2\Enum\Sex")
     */
    private $sex;

    /**
     * @var Region[]
     * @Field(name="regions", type="array<Dsl\MyTarget\Domain\V2\Campaign\Projection\Targeting\Region>")
     */
    private $regions;

    /**
     * @var Fulltime Days and time to show
     * @Field(name="fulltime", type="Dsl\MyTarget\Domain\V1\Targeting\Fulltime")
     */
    private $fulltime;

    /**
     * @var int[]
     * @Field(name="interests", type="array<int>")
     */
    private $interests;

    /**
     * @var V1Enum\TvType[]
     * @Field(name="tv_viewer", type="array<Dsl\MyTarget\Domain\V1\Enum\TvType>")
     */
    private $tvViewer;

    /**
     * @var V1Enum\Education[]
     * @Field(name="ps_education", type="array<Dsl\MyTarget\Domain\V1\Enum\TvType>")
     */
    private $psEducation;

    /**
     * @var V1Enum\Employment[]
     * @Field(type="array<Dsl\MyTarget\Domain\V1\Enum\Employment>")
     */
    private $employment;

    /**
     * @var V1Enum\MaritalStatus[]
     * @Field(name="marital_status", type="array<Dsl\MyTarget\Domain\V1\Enum\MaritalStatus>")
     */
    private $martialStatus;

    /**
     * @var V1Enum\PersonalIncome[]
     * @Field(name="personal_income", type="array<Dsl\MyTarget\Domain\V1\Enum\PersonalIncome>")
     */
    private $personalIncome;

    /**
     * @var RemarketingTargeting[]
     * @Field(name="remarketing", type="array<Dsl\MyTarget\Domain\V1\Targeting\RemarketingTargeting>")
     */
    private $remarketing;

    /**
     * @var Pad[]
     * @Field(name="pads", type="array<Dsl\MyTarget\Domain\V1\Targeting\Pad\Pad>")
     */
    private $pads;

    /**
     * @var V1Enum\MobileType[]
     * @Field(name="mobile_types", type="array<Dsl\MyTarget\Domain\V1\Enum\MobileType>")
     */
    private $mobileTypes;

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
     * @return \int[]
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return \Dsl\MyTarget\Domain\V2\Enum\Sex[]
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return Region[]
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * @return Fulltime
     */
    public function getFulltime()
    {
        return $this->fulltime;
    }

    /**
     * @return \int[]
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * @return V1Enum\TvType[]
     */
    public function getTvViewer()
    {
        return $this->tvViewer;
    }

    /**
     * @return V1Enum\Education[]
     */
    public function getPsEducation()
    {
        return $this->psEducation;
    }

    /**
     * @return V1Enum\Employment[]
     */
    public function getEmployment()
    {
        return $this->employment;
    }

    /**
     * @return V1Enum\MaritalStatus[]
     */
    public function getMartialStatus()
    {
        return $this->martialStatus;
    }

    /**
     * @return V1Enum\PersonalIncome[]
     */
    public function getPersonalIncome()
    {
        return $this->personalIncome;
    }

    /**
     * @return \Dsl\MyTarget\Domain\V1\Targeting\RemarketingTargeting[]
     */
    public function getRemarketing()
    {
        return $this->remarketing;
    }

    /**
     * @return \Dsl\MyTarget\Domain\V1\Targeting\Pad\Pad[]
     */
    public function getPads()
    {
        return $this->pads;
    }

    /**
     * @return V1Enum\MobileType[]
     */
    public function getMobileTypes()
    {
        return $this->mobileTypes;
    }

    /**
     * @return \int[]
     */
    public function getMobileOperatingSystems()
    {
        return $this->mobileOperatingSystems;
    }

    /**
     * @return \int[]
     */
    public function getMobileOperators()
    {
        return $this->mobileOperators;
    }

    /**
     * @return \int[]
     */
    public function getMobileVendors()
    {
        return $this->mobileVendors;
    }

}
