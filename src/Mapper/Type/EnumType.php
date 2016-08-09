<?php

namespace Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Domain\AbstractEnum;
use Dsl\MyTarget\Mapper\Mapper;

class EnumType implements Type
{
    /**
     * @inheritdoc
     */
    public function hydrated($value, $type, Mapper $mapper)
    {
        if (AbstractEnum::isValidValueForClass($type, $value)) {
            return AbstractEnum::fromValueForClass($type, $value);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function snapshot($value, $type, Mapper $mapper)
    {
        if ( ! $value instanceof AbstractEnum) {
            return null;
        }

        return $value->getValue();
    }
}
