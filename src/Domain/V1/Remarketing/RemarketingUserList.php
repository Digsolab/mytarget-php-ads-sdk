<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Mapper\Annotation\Field;
use MyTarget\Domain\V1\Enum\RemarketingUserListStatus;
use MyTarget\Domain\V1\Enum\RemarketingUserListType;

class RemarketingUserList
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var RemarketingUserListType
     * @Field(type="MyTarget\Domain\V1\Enum\RemarketingUserListType")
     */
    private $type;

    /**
     * @var int
     * @Field(type="int", name="users_count")
     */
    private $usersCount;

    /**
     * @var RemarketingUserListStatus
     * @Field(type="MyTarget\Domain\V1\Enum\RemarketingUserListStatus")
     */
    private $status;

    /**
     * @var int
     * @Field(type="int")
     */
    private $base;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return RemarketingUserListType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getUsersCount()
    {
        return $this->usersCount;
    }

    /**
     * @return RemarketingUserListStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getBase()
    {
        return $this->base;
    }
}
