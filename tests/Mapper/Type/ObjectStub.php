<?php

namespace MyTarget\Mapper\Type;

use MyTarget\Mapper\Annotation\Field;

class ObjectStub
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $integerValue;

    /**
     * @return int
     */
    public function getIntegerValue()
    {
        return $this->integerValue;
    }
}
