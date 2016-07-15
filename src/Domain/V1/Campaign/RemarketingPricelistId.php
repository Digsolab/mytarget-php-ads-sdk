<?php

namespace MyTarget\Domain\V1\Campaign;

use MyTarget\Mapper\Annotation\Field;

class RemarketingPricelistId
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @param int $id
     */
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
