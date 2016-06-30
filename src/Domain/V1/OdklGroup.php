<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class OdklGroup
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="title", type="string")
     */
    private $title;

    /**
     * @var int
     * @Field(name="participants", type="int")
     */
    private $participants;

    /**
     * @var string
     * @Field(name="url", type="string")
     */
    private $url;
}
