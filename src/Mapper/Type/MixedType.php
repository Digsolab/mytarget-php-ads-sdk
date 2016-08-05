<?php

namespace Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Mapper\Mapper;

class MixedType implements Type
{
    /**
     * @inheritdoc
     */
    public function hydrated($value, $type, Mapper $mapper)
    {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function snapshot($value, $type, Mapper $mapper)
    {
        return $value;
    }
}
