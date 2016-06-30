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
}
