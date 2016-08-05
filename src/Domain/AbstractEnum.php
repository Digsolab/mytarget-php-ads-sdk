<?php

namespace Dsl\MyTarget\Domain;

use Dsl\MyTarget\Domain\Exception\InvalidEnumNameException;
use Dsl\MyTarget\Domain\Exception\InvalidEnumValueException;

/**
 * Identity enum, makes sure that enum objects of the same value are always identical
 */
abstract class AbstractEnum
{
    /** @var AbstractEnum[][] */
    private static $registry;

    /**
     * @var string
     */
    private $value;

    private final function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param string|int|float $value
     * @return static
     */
    public static function fromValue($value)
    {
        return self::fromValueForClass(get_called_class(), $value);
    }

    /**
     * @param string $class
     * @param string|int|float $value
     *
     * @return AbstractEnum|static
     */
    public static function fromValueForClass($class, $value)
    {
        $consts = self::getConstants($class);

        $key = array_search($value, $consts, true);
        if ($key === false) {
            throw InvalidEnumValueException::create($value, $class);
        }

        if ( ! isset(self::$registry[$class][$key])) {
            return self::$registry[$class][$key] = new $class($value);
        }

        return self::$registry[$class][$key];
    }

    /**
     * @param string $name
     * @return static
     */
    public static function fromName($name)
    {
        $class = get_called_class();
        $consts = self::getConstants($class);

        if ( ! isset(self::$registry[$class][$name])) {
            if ( ! isset($consts[$name])) {
                throw InvalidEnumNameException::create($name, $class);
            }

            return self::$registry[$class][$name] = new static($consts[$name]);
        }

        return self::$registry[$class][$name];
    }

    /**
     * @param string $class
     * @param string|int|float $value
     *
     * @return bool
     */
    public static function isValidValueForClass($class, $value)
    {
        $consts = self::getConstants($class);

        return in_array($value, $consts, true);
    }

    /**
     * @param string $class
     * @return array
     */
    private static function getConstants($class)
    {
        $ref = new \ReflectionClass($class);

        return $ref->getConstants();
    }
}
