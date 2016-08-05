<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class StatisticType extends AbstractEnum
{
    const HOUR = 'hour';
    const DAY = 'day';

    /**
     * @return StatisticType
     */
    public static function hour()
    {
        return self::fromValue(self::HOUR);
    }

    /**
     * @return StatisticType
     */
    public static function day()
    {
        return self::fromValue(self::DAY);
    }
}
