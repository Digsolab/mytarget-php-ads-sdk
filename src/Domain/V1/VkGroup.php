<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class VkGroup
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     * @Field(name="shortname", type="string")
     */
    private $shortName;

    /**
     * @var int
     * @Field(name="members_count", type="int")
     */
    private $membersCount;

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
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @return int
     */
    public function getMembersCount()
    {
        return $this->membersCount;
    }
}
