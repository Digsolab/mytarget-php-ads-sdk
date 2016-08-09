<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Domain\V1\Enum\RemarketingGroupType;
use Dsl\MyTarget\Mapper\Annotation\Field;

class RemarketingGroup
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var RemarketingGroupType
     * @Field(type="Dsl\MyTarget\Domain\V1\Enum\RemarketingGroupType")
     */
    private $type;

    /**
     * @var int
     * @Field(name="object_id", type="int")
     */
    private $objectId;

    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var int
     * @Field(name="users_count", type="int")
     */
    private $usersCount;

    /**
     * @param RemarketingGroupType $type
     * @param int $objectId
     */
    public function __construct(RemarketingGroupType $type, $objectId)
    {
        $this->type = $type;
        $this->objectId = $objectId;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return RemarketingGroupType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getObjectId()
    {
        return $this->objectId;
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
    public function getUsersCount()
    {
        return $this->usersCount;
    }
}
