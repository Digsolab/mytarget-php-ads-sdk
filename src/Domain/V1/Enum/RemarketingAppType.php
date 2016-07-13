<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class RemarketingAppType extends AbstractEnum
{
    const ODKL = "odkl_app";
    const MIR = "mir_app";

    /**
     * @return RemarketingAppType
     */
    public function odkl()
    {
        return self::fromValue(self::ODKL);
    }

    /**
     * @return RemarketingAppType
     */
    public function mir()
    {
        return self::fromValue(self::MIR);
    }
}
