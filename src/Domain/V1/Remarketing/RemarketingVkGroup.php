<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Mapper\Annotation\Field;

class RemarketingVkGroup
{
    /**
     * @var int
     * @Field(name="group_id", type="int")
     */
    private $groupId;

    /**
     * @param int $groupId
     */
    public function __construct($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }
}
