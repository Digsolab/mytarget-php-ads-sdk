<?php

namespace Dsl\MyTarget\Domain\V1\Targeting;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Birthday
{
    /**
     * @var int
     * @Field(name="days_before", type="nullableInt")
     */
    private $daysBefore;

    /**
     * @var int
     * @Field(name="days_after", type="nullableInt")
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
