<?php

namespace MyTarget\Domain\V2;

use MyTarget\Mapper\Annotation\Field;

class Creative
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var CreativeVariant[]
     * @Field(type="MyTarget\Domain\V2\CreativeVariant")
     */
    private $variants;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return CreativeVariant[]
     */
    public function getVariants()
    {
        return $this->variants;
    }
}
