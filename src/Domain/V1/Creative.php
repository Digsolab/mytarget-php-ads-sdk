<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\V1\Enum\CreativeType;
use MyTarget\Mapper\Annotation\Field;

class Creative
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var CreativeType
     * @Field(type="MyTarget\Domain\V1\Enum\CreativeType")
     */
    private $type;

    /**
     * @var CreativeVariant[]
     * @Field(type="MyTarget\Operator\V1\CreativeVariant")
     */
    private $variants;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return CreativeType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return CreativeVariant[]
     */
    public function getVariants()
    {
        return $this->variants;
    }
}
