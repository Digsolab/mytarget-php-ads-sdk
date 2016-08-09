<?php

namespace Dsl\MyTarget\Domain\Exception;

class InvalidEnumNameException extends \InvalidArgumentException
{
    /**
     * @param string $name
     * @param string $enumClass
     *
     * @return static
     */
    public static function create($name, $enumClass)
    {
        return static(sprintf('Name "%s" does not exist in %s', $name, $enumClass));
    }
}
