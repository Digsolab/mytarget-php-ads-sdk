<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class RemarketingLoadedStatus extends AbstractEnum
{
    const LOADING = 'loading';
    const LOADED = 'loaded';
    const UNLOADED = 'unloaded';

    /**
     * @return RemarketingLoadedStatus
     */
    public static function loading()
    {
        return self::fromValue(self::LOADING);
    }

    /**
     * @return RemarketingLoadedStatus
     */
    public static function loaded()
    {
        return self::fromValue(self::LOADED);
    }

    /**
     * @return RemarketingLoadedStatus
     */
    public static function unloaded()
    {
        return self::fromValue(self::UNLOADED);
    }
}
