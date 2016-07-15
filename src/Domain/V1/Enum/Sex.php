<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class Sex extends AbstractEnum
{
    const MALE = 'M';
    const FEMALE = 'F';
    const BOTH = 'MF';

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
    public static function both()
    {
        return Sex::fromValue(self::BOTH);
    }
}
