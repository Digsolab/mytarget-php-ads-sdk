<?php

namespace Dsl\MyTarget\Mapper;

use Dsl\MyTarget\Domain\AbstractEnum;
use Dsl\MyTarget\Mapper\Exception\TypeParsingException;
use Dsl\MyTarget\Mapper\Type\Type;

class Mapper
{
    /**
     * @var Type[]
     */
    private $types;

    /**
     * @param Type[] $types
     */
    public function __construct(array $types)
    {
        $this->types = $types;
    }

    /**
     * Creates a new object of type $type and hydrates it with the
     * seeded data (usually received from API)
     *
     * @param string $type
     * @param mixed $data
     *
     * @return object
     */
    public function hydrateNew($type, $data)
    {
        return $this->forType($type)->hydrated($data, $type, $this);
    }

    /**
     * Creates snapshot of an object (or array of objects) ready for
     * sending to the API after JSON-encoding it
     *
     * @param mixed $data
     * @param null|string $type
     *
     * @return mixed
     */
    public function snapshot($data, $type = null)
    {
        $type = $type ?: (is_object($data) ? get_class($data) : null);

        return $this->forType($type)->snapshot($data, $type, $this);
    }

    /**
     * @param string $type
     * @return Type
     */
    protected function forType($type)
    {
        $pattern = "!^(?:"
            . "(?<array_type>array)"
            . "|(?<scalar_type>int|bool|float|string)"
            . "|(?<nullable_scalar_type>nullableInt|nullableBool|nullableFloat|nullableString)"
            . "|(?<mixed>mixed)"
            . "|(?<dict>dict)"
            . "|(?<date_type>DateTime)"
            . "|(?<object_type>[^<]+)"
            . ")!";
        if ( ! preg_match($pattern, $type, $parsed)) {
            throw new TypeParsingException($type);
        }

        if (isset($parsed["array_type"][0])) {
            return $this->types["array"];
        } elseif (isset($parsed["scalar_type"][0])) {
            return $this->types["scalar"];
        } elseif (isset($parsed["nullable_scalar_type"][0])) {
            return $this->types["nullable_scalar"];
        } elseif (isset($parsed["date_type"][0])) {
            return $this->types["date"];
        } elseif (isset($parsed["mixed"][0])) {
            return $this->types["mixed"];
        } elseif (isset($parsed["dict"][0])) {
            return $this->types["dict"];
        } else {
            if (is_subclass_of($type, AbstractEnum::class, true)) {
                return $this->types["enum"];
            } else {
                return $this->types["object"];
            }
        }
    }
}
