<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class DetailedExactDemography
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var DemographyExactAge[]
     * @Field(type="array<MyTarget\Domain\V1\DemographyExactAge>")
     */
    private $histogram;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DemographyExactAge[]
     */
    public function getHistogram()
    {
        return $this->histogram;
    }
}
