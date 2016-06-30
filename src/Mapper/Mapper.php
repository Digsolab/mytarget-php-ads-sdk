<?php

namespace MyTarget\Mapper;

use MyTarget\Domain\AbstractEnum;
use MyTarget\Mapper\Exception\TypeParsingException;
use MyTarget\Mapper\Type\Type;

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
     * @param string $type
     * @param mixed $data
     * @return object
     */
    public function hydrateNew($type, $data)
    {
        return $this->forType($type)->hydrated($data, $type, $this);
    }

    /**
     * @param mixed $data
     * @param null|string $type
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
            . "(?<array_type>array)|(?<scalar_type>int|bool|float|string)"
            . "|(?<mixed>mixed)"
            . "|(?<date_type>DateTime)|(?<object_type>[^<]+)"
            . ")!";
        if ( ! preg_match($pattern, $type, $parsed)) {
            throw new TypeParsingException($type);
        }

        if (isset($parsed["array_type"][0])) {
            return $this->types["array"];
        } elseif (isset($parsed["scalar_type"][0])) {
            return $this->types["scalar"];
        } elseif (isset($parsed["date_type"][0])) {
            return $this->types["date"];
        } elseif (isset($parsed["mixed"][0])) {
            return $this->types["mixed"];
        } else {
            if (is_subclass_of($type, AbstractEnum::class, true)) {
                return $this->types["enum"];
            } else {
                return $this->types["object"];
            }
        }
    }
}
