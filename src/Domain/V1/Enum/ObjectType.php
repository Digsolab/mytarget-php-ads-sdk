<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class ObjectType extends AbstractEnum
{
    const BANNER = 'banners';
    const CAMPAIGN = 'campaigns';
    const PAD_GROUP = 'pad_groups';
    const PAD = 'pads';

    /**
     * @return ObjectType
     */
    public static function banner()
    {
        return self::fromValue(self::BANNER);
    }

    /**
     * @return ObjectType
     */
    public static function campaign()
    {
        return self::fromValue(self::CAMPAIGN);
    }

    /**
     * @return ObjectType
     */
    public static function padGroup()
    {
        return self::fromValue(self::PAD_GROUP);
    }

    /**
     * @return ObjectType
     */
    public static function pad()
    {
        return self::fromValue(self::PAD);
    }
}
