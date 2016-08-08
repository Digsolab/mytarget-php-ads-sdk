<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class MaritalStatus extends AbstractEnum
{
    const MARRIED = 'married';
    const NOT_MARRIED = 'unmarried';

    /**
     * @return MaritalStatus
     */
    public static function married()
    {
        return self::fromValue(self::MARRIED);
    }

    /**
     * @return MaritalStatus
     */
    public static function notMarried()
    {
        return self::fromValue(self::NOT_MARRIED);
    }
}
