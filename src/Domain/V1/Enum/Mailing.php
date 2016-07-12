<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

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
    public function news()
    {
        return Mailing::fromValue(self::NEWS);
    }

    /**
     * @return Mailing
     */
    public function finance()
    {
        return Mailing::fromValue(self::FINANCE);
    }

    /**
     * @return Mailing
     */
    public function event()
    {
        return Mailing::fromValue(self::EVENT);
    }

    /**
     * @return Mailing
     */
    public function moderation()
    {
        return Mailing::fromValue(self::MODERATION);
    }

    /**
     * @return Mailing
     */
    public function other()
    {
        return Mailing::fromValue(self::OTHER);
    }
}
