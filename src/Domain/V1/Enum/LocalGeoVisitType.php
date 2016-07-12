<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class LocalGeoVisitType extends AbstractEnum
{
    const NOW = 'now';
    const USUAL = 'usual';

    /**
     * @return LocalGeoVisitType
     */
    public function now()
    {
        return LocalGeoVisitType::fromValue(self::NOW);
    }

    /**
     * @return LocalGeoVisitType
     */
    public function usual()
    {
        return LocalGeoVisitType::fromValue(self::USUAL);
    }
}
