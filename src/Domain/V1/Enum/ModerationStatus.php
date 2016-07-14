<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class ModerationStatus extends AbstractEnum
{
    const NEW_ = 'new';
    const CHANGED = 'changed';
    const DELAYED = 'delayed';
    const ALLOWED = 'allowed';
    const BANNED = 'banned';

    /**
     * @return ModerationStatus
     */
    public static function new_()
    {
        return ModerationStatus::fromValue(self::NEW_);
    }

    /**
     * @return ModerationStatus
     */
    public static function changed()
    {
        return ModerationStatus::fromValue(self::CHANGED);
    }

    /**
     * @return ModerationStatus
     */
    public static function delayed()
    {
        return ModerationStatus::fromValue(self::DELAYED);
    }

    /**
     * @return ModerationStatus
     */
    public static function allowed()
    {
        return ModerationStatus::fromValue(self::ALLOWED);
    }

    /**
     * @return ModerationStatus
     */
    public static function banned()
    {
        return ModerationStatus::fromValue(self::BANNED);
    }
}
