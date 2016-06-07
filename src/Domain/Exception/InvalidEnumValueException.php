<?php

namespace MyTarget\Domain\Exception;

class InvalidEnumValueException extends \RuntimeException
{
    /**
     * @param string $value
     * @param string $enumClass
     * @return InvalidEnumValueException
     */
    public static function create($value, $enumClass)
    {
        return new InvalidEnumValueException(sprintf('Value "%s" does not exist in %s', $value, $enumClass));
    }
}
