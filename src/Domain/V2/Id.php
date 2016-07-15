<?php

namespace MyTarget\Domain\V2;

use MyTarget\Mapper\Annotation\Field;

class Id
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
