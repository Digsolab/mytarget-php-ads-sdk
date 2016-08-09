<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class TvType extends AbstractEnum
{
    const HTV = 'htv';
    const MTV = 'mtv';
    const LTW = 'ltw';

    /**
     * @return TvType
     */
    public static function htv()
    {
        return self::fromValue(self::HTV);
    }

    /**
     * @return TvType
     */
    public static function mtv()
    {
        return self::fromValue(self::MTV);
    }

    /**
     * @return TvType
     */
    public static function ltw()
    {
        return self::fromValue(self::LTW);
    }
}
