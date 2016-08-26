<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class RemarketingType extends AbstractEnum
{
    const POSITIVE = "positive";
    const NEGATIVE = "negative";

    /**
     * @return RemarketingType
     */
    public static function positive()
    {
        return self::fromValue(self::POSITIVE);
    }

    /**
     * @return RemarketingType
     */
    public static function negative()
    {
        return self::fromValue(self::NEGATIVE);
    }
}
