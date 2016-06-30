<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class AppRecommendation
{
    /**
     * @var int
     * @Field(name="score_threshold", type="int")
     */
    private $scoreThreshold;
}
