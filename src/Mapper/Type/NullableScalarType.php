<?php

namespace Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Mapper\Mapper;

class NullableScalarType extends ScalarType
{
    /**
     * @inheritdoc
     */
    public function hydrated($value, $type, Mapper $mapper)
    {
        if (null === $value) {
            return null; 
        }

        return parent::hydrated($value, $type, $mapper);
    }
}
