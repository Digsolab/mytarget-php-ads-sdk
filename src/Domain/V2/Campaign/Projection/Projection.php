<?php

namespace Dsl\MyTarget\Domain\V2\Campaign\Projection;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Projection
{
    /**
     * @var string
     * @Field(type="string")
     */
    private $currency;

    /**
     * @var int
     * @Field(type="int")
     */
    private $days;

    /**
     * @var float
     * @Field(type="float", name="approximate_ctr")
     */
    private $approximateCtr;

    /**
     * @var ProjectionPoint[]
     * @Field(type="array<Dsl\MyTarget\Domain\V1\Campaign\Projection\ProjectionPoint>", name="histogram")
     */
    private $histogram;

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @return float
     */
    public function getApproximateCtr()
    {
        return $this->approximateCtr;
    }

    /**
     * @return ProjectionPoint[]
     */
    public function getHistogram()
    {
        return $this->histogram;
    }
}
