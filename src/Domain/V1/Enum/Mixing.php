<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class Mixing extends AbstractEnum
{
    const FASTEST = 'fastest';
    const RECOMMENDED = 'recommended';
    const NONE = 'None';

    /**
     * @return Mixing
     */
    public function fastest()
    {
        return Mixing::fromValue(self::FASTEST);
    }

    /**
     * @return Mixing
     */
    public function recommended()
    {
        return Mixing::fromValue(self::RECOMMENDED);
    }

    /**
     * @return Mixing
     */
    public function none()
    {
        return Mixing::fromValue(self::NONE);
    }
}
