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
     * @Field(type="MyTarget\Domain\V1\CreativeVariant")
     */
    private $variants;

    /**
     * @return int
     */
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

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param CreativeType $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param CreativeVariant[] $variants
     */
    public function setVariants($variants)
    {
        $this->variants = $variants;
    }
}
