<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class RemarketingType extends AbstractEnum
{
    const POSITIVE = "positive";
    const NEGATIVE = "negative";

    /**
     * @return RemarketingType
     */
    public function positive()
    {
        return self::fromValue(self::POSITIVE);
    }

    /**
     * @return RemarketingType
     */
    public function negative()
    {
        return self::fromValue(self::NEGATIVE);
    }
}
