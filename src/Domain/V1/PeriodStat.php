<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class PeriodStat
{
    /**
     * @var int
     * @Field(name="clicks", type="int")
     */
    private $clicks;

    /**
     * @var int
     * @Field(name="shows", type="int")
     */
    private $shows;

    /**
     * @var string
     * @Field(name="amount", type="string")
     */
    private $amount;

    /**
     * @var \DateTime
     * @Field(name="date", type="DateTime")
     */
    private $date;

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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
