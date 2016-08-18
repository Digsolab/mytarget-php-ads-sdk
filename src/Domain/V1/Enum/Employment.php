<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class Employment extends AbstractEnum
{
    const YES = "employment_yes";
    const NO = "employment_no";

    /**
     * @return Employment
     */
    public static function yes()
    {
        return Employment::fromValue(self::YES);
    }

    /**
     * @return Employment
     */
    public static function no()
    {
        return Employment::fromValue(self::NO);
    }
}
