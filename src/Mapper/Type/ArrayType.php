<?php

namespace Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Mapper\Mapper;

class ArrayType implements Type
{
    /**
     * @inheritdoc
     */
    public function hydrated($value, $type, Mapper $mapper)
    {
        if ( ! is_array($value)) {
            return null;
        }

        $innerType = null;
        if (preg_match('!^array<(?<type>.+?)>$!', $type, $parsed)) {
            $innerType = $parsed["type"];
        }

        $output = [];

        if ($innerType !== null) {
            foreach ($value as $key => $each) {
                $converted = $mapper->hydrateNew($innerType, $each);

                if ($converted !== null) {
                    $output[$key] = $converted;
                }
            }
        } else {
            $output = $value;
        }

        return $output;
    }

    /**
     * @inheritdoc
     */
    public function snapshot($value, $type, Mapper $mapper)
    {
        if ( ! is_array($value)) {
            return null;
        }

        $innerType = null;
        if (preg_match('!^array<(?<type>.+?)>$!', $type, $parsed)) {
            $innerType = $parsed["type"];
        }

        $output = [];

        if ($innerType !== null) {
            foreach ($value as $key => $each) {
                $snapshot = $mapper->snapshot($each, $innerType);

                if ($snapshot !== null) {
                    $output[$key] = $snapshot;
                }
            }
        } else {
            $output = $value;
        }

        return $output;
    }
}
