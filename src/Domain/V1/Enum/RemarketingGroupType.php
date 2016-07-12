<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class RemarketingGroupType extends AbstractEnum
{
    const GROUP = "group";
    const SCOPE = "scope";

    /**
     * @return RemarketingGroupType
     */
    public function group()
    {
        return self::fromValue(self::GROUP);
    }

    /**
     * @return RemarketingGroupType
     */
    public function scope()
    {
        return self::fromValue(self::SCOPE);
    }
}
