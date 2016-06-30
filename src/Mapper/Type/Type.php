<?php

namespace MyTarget\Mapper\Type;

use MyTarget\Mapper\Mapper;

interface Type
{
    /**
     * @param mixed $value
     * @param string $type
     * @param Mapper $mapper
     * @return mixed
     */
    public function hydrated($value, $type, Mapper $mapper);

    /**
     * @param mixed $value
     * @param string $type
     * @param Mapper $mapper
     * @return mixed
     */
    public function snapshot($value, $type, Mapper $mapper);
}
