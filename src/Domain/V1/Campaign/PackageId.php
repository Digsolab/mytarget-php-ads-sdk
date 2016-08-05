<?php

namespace Dsl\MyTarget\Domain\V1\Campaign;

use Dsl\MyTarget\Mapper\Annotation\Field;

class PackageId
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
