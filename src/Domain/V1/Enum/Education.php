<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class Education extends AbstractEnum
{
    const YES = "education_yes";
    const NO = "education_no";

    /**
     * @return Education
     */
    public function yes()
    {
        return self::fromValue(self::YES);
    }

    /**
     * @return Education
     */
    public function no()
    {
        return self::fromValue(self::NO);
    }
}
