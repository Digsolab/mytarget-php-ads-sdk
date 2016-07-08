<?php

namespace MyTarget\Mapper\Type;

use MyTarget\Mapper\Mapper;

/**
 * Implements data mapper for a particular type (or a kind)
 */
interface Type
{
    /**
     * Returns hydrated value, from plain form, which can be used
     * as a hydrated object field (or/and is a hydrated object itself)
     *
     * @param mixed $value
     * @param string $type
     * @param Mapper $mapper
     *
     * @return mixed
     */
    public function hydrated($value, $type, Mapper $mapper);

    /**
     * Returns value ready to be sent to the API after JSON-encoding it
     *
     * @param mixed $value
     * @param string $type
     * @param Mapper $mapper
     *
     * @return mixed
     */
    public function snapshot($value, $type, Mapper $mapper);
}
