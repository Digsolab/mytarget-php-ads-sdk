<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class RemarketingTargeting
{
    /**
     * @var int
     * @Field(name="score_threshold", type="int")
     */
    private $scoreThreshold;
}
