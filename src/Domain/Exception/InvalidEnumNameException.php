<?php

namespace MyTarget\Domain\Exception;

class InvalidEnumNameException extends \RuntimeException
{
    /**
     * @param string $name
     * @param string $enumClass
     * @return InvalidEnumNameException
     */
    public static function create($name, $enumClass)
    {
        return new InvalidEnumNameException(sprintf('Name "%s" does not exist in %s', $name, $enumClass));
    }
}
