<?php

namespace Dsl\MyTarget\Domain\V1;

use Dsl\MyTarget\Domain\V1\Enum\CreativeType;
use Dsl\MyTarget\Mapper\Annotation\Field;

class Creative
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var CreativeType
     * @Field(type="Dsl\MyTarget\Domain\V1\Enum\CreativeType")
     */
    private $type;

    /**
     * @var CreativeVariant[]
     * @Field(type="array<Dsl\MyTarget\Domain\V1\CreativeVariant>")
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
