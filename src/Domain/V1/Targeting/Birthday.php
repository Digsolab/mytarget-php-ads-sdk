<?php

namespace MyTarget\Domain\V1\Targeting;

use MyTarget\Mapper\Annotation\Field;

class Birthday
{
    /**
     * @var int
     * @Field(name="days_before", type="int")
     */
    private $daysBefore;

    /**
     * @var int
     * @Field(name="days_after", type="int")
     */
    private $daysAfter;

    /**
     * @param int $daysBefore
     * @param int $daysAfter
     */
    public function __construct($daysBefore, $daysAfter)
    {
        $this->daysBefore = $daysBefore;
        $this->daysAfter = $daysAfter;
    }

    /**
     * @return int
     */
    public function getDaysBefore()
    {
        return $this->daysBefore;
    }

    /**
     * @return int
     */
    public function getDaysAfter()
    {
        return $this->daysAfter;
    }
}
