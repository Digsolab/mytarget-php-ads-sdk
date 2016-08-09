<?php

namespace Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Mapper\Mapper;

class ScalarType implements Type
{
    /**
     * @inheritdoc
     */
    public function hydrated($value, $type, Mapper $mapper)
    {
        switch ($type) {
            case "int":    return (int)$value;
            case "bool":   return (bool)$value;
            case "float":  return (float)$value;
            case "string": return (string)$value;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function snapshot($value, $type, Mapper $mapper)
    {
        if ( ! is_scalar($value)) {
            return null;
        }

        return $value;
    }
}
