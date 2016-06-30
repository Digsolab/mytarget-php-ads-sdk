<?php

namespace MyTarget\Domain\V1\Pad;

use MyTarget\Mapper\Annotation\Field;

class EyeUrl
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="url", type="string")
     */
    private $url;

    /**
     * @var string
     * @Field(name="description", type="string")
     */
    private $description;
}
