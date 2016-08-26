<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Domain\V1\Enum\RemarketingLoadedStatus;
use Dsl\MyTarget\Mapper\Annotation\Field;

class RemarketingVkAppStat extends RemarketingVkApp
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var RemarketingLoadedStatus
     * @Field(type="Dsl\MyTarget\Domain\V1\Enum\RemarketingLoadedStatus")
     */
    private $status;

    /**
     * @var int
     * @Field(name="members_count", type="int")
     */
    private $membersCount;

    /**
     * @var int
     * @Field(name="loaded_members_count", type="int")
     */
    private $loadedMembersCount;

    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var string
     * @Field(type="string")
     */
    private $shortname;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return RemarketingLoadedStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getMembersCount()
    {
        return $this->membersCount;
    }

    /**
     * @return int
     */
    public function getLoadedMembersCount()
    {
        return $this->loadedMembersCount;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }
}
