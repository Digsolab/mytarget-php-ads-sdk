<?php

namespace Dsl\MyTarget\Domain\V1\Demography;

use Dsl\MyTarget\Mapper\Annotation\Field;

class DemographyExactAge
{
    /**
     * @var float|null
     * @Field(type="float")
     */
    private $ctr;

    /**
     * @var int
     * @Field(type="int")
     */
    private $age;

    /**
     * @var string
     * @Field(type="string")
     */
    private $sex;

    /**
     * @var float
     * @Field(type="float", name="share_shows")
     */
    private $shareShows;

    /**
     * @var float
     * @Field(type="float", name="share_clicks")
     */
    private $shareClicks;

    /**
     * @return float|null
     */
    public function getCtr()
    {
        return $this->ctr;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return float
     */
    public function getShareShows()
    {
        return $this->shareShows;
    }

    /**
     * @return float
     */
    public function getShareClicks()
    {
        return $this->shareClicks;
    }

}
