<?php

namespace MyTarget\Domain\V1;

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
}
