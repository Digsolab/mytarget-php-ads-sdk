<?php

namespace Dsl\MyTarget\Domain\V2;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Creative
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var CreativeVariant[]
     * @Field(type="dict<Dsl\MyTarget\Domain\V2\CreativeVariant>")
     */
    private $variants;

    /**
     * @param int $id
     * @param CreativeVariant[] $variants
     */
    public function __construct($id, array $variants)
    {
        $this->id = $id;
        $this->variants = $variants;
    }

    /**
     * @return int
     */
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
