<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Domain\V1\Enum\Status;
use Dsl\MyTarget\Mapper\Annotation\Field;

class RemarketingCounter
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var Status
     * @Field(type="Dsl\MyTarget\Domain\V1\Enum\Status")
     */
    private $status;

    /**
     * @var Status
     * @Field(name="system_status", type="Dsl\MyTarget\Domain\V1\Enum\Status")
     */
    private $systemStatus;

    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var int
     * @Field(name="counter_id", type="int")
     */
    private $counterId;

    /**
     * @var array[]
     * @Field(type="array<dict>")
     */
    private $goals;

    /**
     * @param int $counterId
     * @param Status $systemStatus
     */
    public function __construct($counterId, Status $systemStatus = null)
    {
        $this->counterId = $counterId;
        $this->systemStatus = $systemStatus;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Status
     */
    public function getSystemStatus()
    {
        return $this->systemStatus;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCounterId()
    {
        return $this->counterId;
    }

    /**
     * @return \array[]
     */
    public function getGoals()
    {
        return $this->goals;
    }
}
