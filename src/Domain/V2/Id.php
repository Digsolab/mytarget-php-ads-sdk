<?php

namespace Dsl\MyTarget\Domain\V2;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Id
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
