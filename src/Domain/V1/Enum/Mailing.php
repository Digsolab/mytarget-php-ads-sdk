<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class Mailing extends AbstractEnum
{
    const NEWS = 'news';
    const FINANCE = 'finance';
    const EVENT = 'event';
    const MODERATION = 'moderation';
    const OTHER = 'other';

    /**
     * @return Mailing
     */
    public static function news()
    {
        return Mailing::fromValue(self::NEWS);
    }

    /**
     * @return Mailing
     */
    public static function finance()
    {
        return Mailing::fromValue(self::FINANCE);
    }

    /**
     * @return Mailing
     */
    public static function event()
    {
        return Mailing::fromValue(self::EVENT);
    }

    /**
     * @return Mailing
     */
    public static function moderation()
    {
        return Mailing::fromValue(self::MODERATION);
    }

    /**
     * @return Mailing
     */
    public static function other()
    {
        return Mailing::fromValue(self::OTHER);
    }
}
