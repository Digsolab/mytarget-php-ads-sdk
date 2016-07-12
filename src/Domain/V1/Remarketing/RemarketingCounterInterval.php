<?php

namespace MyTarget\Domain\V1\Remarketing;

use MyTarget\Domain\V1\Enum\RemarketingType;
use MyTarget\Mapper\Annotation\Field;

class RemarketingCounterInterval extends RemarketingInterval
{
    /**
     * @var int
     * @Field(name="counter_id", type="int")
     */
    private $counterId;

    /**
     * @var string
     * @Field(name="goal_id", type="string")
     */
    private $goalId;

    /**
     * @param int $left
     * @param int $right
     * @param RemarketingType $type
     * @param int $counterId
     * @param string $goalId
     */
    public function __construct($left, $right, RemarketingType $type, $counterId, $goalId)
    {
        parent::__construct($left, $right, $type);

        $this->counterId = $counterId;
        $this->goalId = $goalId;
    }

    /**
     * @return int
     */
    public function getCounterId()
    {
        return $this->counterId;
    }

    /**
     * @return string
     */
    public function getGoalId()
    {
        return $this->goalId;
    }
}
