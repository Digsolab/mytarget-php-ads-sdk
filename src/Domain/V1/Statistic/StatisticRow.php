<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

use Dsl\MyTarget\Mapper\Annotation\Field;

class StatisticRow
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $clicks;

    /**
     * @var int
     * @Field(type="int")
     */
    private $shows;

    /**
     * @var string
     * @Field(type="string")
     */
    private $amount;

    /**
     * @var string|null
     * @Field(type="string")
     */
    private $ctr;

    /**
     * @return int
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * @return int
     */
    public function getShows()
    {
        return $this->shows;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return null|string
     */
    public function getCtr()
    {
        return $this->ctr;
    }
}
