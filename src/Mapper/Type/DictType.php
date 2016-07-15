<?php

namespace MyTarget\Mapper\Type;

use MyTarget\Mapper\Mapper;

class DictType implements  Type
{
    /**
     * @inheritdoc
     */
    public function hydrated($value, $type, Mapper $mapper)
    {
        if ($value instanceof \stdClass) {
            $value = (array)$value;
        } elseif ( ! is_array($value)) {
            return null;
        }

        if (preg_match('!^dict<(?<type>.+?)>$!', $type, $parsed)) {
            $innerType = $parsed["type"];
            $output = [];
            foreach ($value as $key => $each) {
                $converted = $mapper->hydrateNew($innerType, $each);

                if ($converted !== null) {
                    $output[$key] = $converted;
                }
            }

            return $output;
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    public function snapshot($value, $type, Mapper $mapper)
    {
        if ( ! is_array($value)) {
            return null;
        }

        if (preg_match('!^dict<(?<type>.+?)>$!', $type, $parsed)) {
            $innerType = $parsed["type"];
            $output = [];
            foreach ($value as $key => $each) {
                $converted = $mapper->snapshot($each, $innerType);

                if ($converted !== null) {
                    $output[$key] = $converted;
                }
            }

            $value = $output;
        }

        return (object)$value;
    }
}
