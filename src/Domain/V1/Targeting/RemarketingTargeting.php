<?php

namespace MyTarget\Domain\V1\Targeting;

use MyTarget\Mapper\Annotation\Field;

class RemarketingTargeting
{
    /**
     * @var int
     * @Field(name="score_threshold", type="int")
     */
    private $scoreThreshold;

    /**
     * @param int $scoreThreshold
     *
     * @return RemarketingTargeting
     */
    public static function create($scoreThreshold)
    {
        $self = new RemarketingTargeting();
        $self->scoreThreshold = $scoreThreshold;

        return $self;
    }

    /**
     * @param int $scoreThreshold
     */
    public function setScoreThreshold($scoreThreshold)
    {
        $this->scoreThreshold = $scoreThreshold;
    }

    /**
     * @return int
     */
    public function getScoreThreshold()
    {
        return $this->scoreThreshold;
    }
}
