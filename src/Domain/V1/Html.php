<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class Html
{
    /**
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @Field(name="url", type="string")
     */
    private $url;
}
