<?php

namespace MyTarget\Domain\V1\Remarketing;

use MyTarget\Mapper\Annotation\Field;

class RemarketingVkApp
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
