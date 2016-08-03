<?php

namespace MyTarget\Domain\Exception;

class InvalidEnumValueException extends \InvalidArgumentException
{
    /**
     * @param string $value
     * @param string $enumClass
     *
     * @return static
     */
    public static function create($value, $enumClass)
    {
        return static(sprintf('Value "%s" does not exist in %s', $value, $enumClass));
    }
}
