<?php

namespace Dsl\MyTarget\Domain\V2\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class CreativeType extends AbstractEnum
{
    const STATIC_ = 'static';
    const VIDEO = 'video';

    /**
     * @return CreativeType
     */
    public static function static_()
    {
        return CreativeType::fromValue(self::STATIC_);
    }

    /**
     * @return CreativeType
     */
    public static function video()
    {
        return CreativeType::fromValue(self::VIDEO);
    }
}
