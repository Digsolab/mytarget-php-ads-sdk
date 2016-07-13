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
    public function loading()
    {
        return self::fromValue(self::LOADING);
    }

    /**
     * @return RemarketingLoadedStatus
     */
    public function loaded()
    {
        return self::fromValue(self::LOADED);
    }

    /**
     * @return RemarketingLoadedStatus
     */
    public function unloaded()
    {
        return self::fromValue(self::UNLOADED);
    }
}
