<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class MobilePrefix extends AbstractEnum
{
    const MTS = 'mts';
    const BEELINE = 'beeline';
    const MEGAFON = 'megafon';

    /**
     * @return MobilePrefix
     */
    public static function mts()
    {
        return MobilePrefix::fromValue(self::MTS);
    }

    /**
     * @return MobilePrefix
     */
    public static function beeline()
    {
        return MobilePrefix::fromValue(self::BEELINE);
    }

    /**
     * @return MobilePrefix
     */
    public static function megafon()
    {
        return MobilePrefix::fromValue(self::MEGAFON);
    }
}
