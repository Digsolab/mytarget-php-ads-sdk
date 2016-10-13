<?php

namespace Dsl\MyTarget\Domain\V2\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class Sex extends AbstractEnum
{
    const MALE = 'male';
    const FEMALE = 'female';
    const UNKNOWN = 'unknown';

    /**
     * @return Sex
     */
    public static function male()
    {
        return Sex::fromValue(self::MALE);
    }

    /**
     * @return Sex
     */
    public static function female()
    {
        return Sex::fromValue(self::FEMALE);
    }

    /**
     * @return Sex
     */
    public static function unknown()
    {
        return Sex::fromValue(self::UNKNOWN);
    }
}
