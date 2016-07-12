<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class CreativeType extends AbstractEnum
{
    const STATIC_ = 'static';
    const VIDEO = 'video';

    /**
     * @return CreativeType
     */
    public function static_()
    {
        return CreativeType::fromValue(self::STATIC_);
    }

    /**
     * @return CreativeType
     */
    public function video()
    {
        return CreativeType::fromValue(self::VIDEO);
    }
}
