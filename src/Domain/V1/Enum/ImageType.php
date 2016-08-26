<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class ImageType extends AbstractEnum
{
    const STATIC_ = 'static';
    const ANIMATED = 'animated';
    const FLASH = 'flash';
    const VIDEO = 'video';
    const HTML5 = 'html5';

    /**
     * @return ImageType
     */
    public static function static_()
    {
        return ImageType::fromValue(self::STATIC_);
    }

    /**
     * @return ImageType
     */
    public static function animated()
    {
        return ImageType::fromValue(self::ANIMATED);
    }

    /**
     * @return ImageType
     */
    public static function flash()
    {
        return ImageType::fromValue(self::FLASH);
    }

    /**
     * @return ImageType
     */
    public static function video()
    {
        return ImageType::fromValue(self::VIDEO);
    }

    /**
     * @return ImageType
     */
    public static function html5()
    {
        return ImageType::fromValue(self::HTML5);
    }
}
