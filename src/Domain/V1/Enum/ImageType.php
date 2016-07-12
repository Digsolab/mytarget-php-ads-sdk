<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

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
    public function static_()
    {
        return ImageType::fromValue(self::STATIC_);
    }
    /**
     * @return ImageType
     */
    public function animated()
    {
        return ImageType::fromValue(self::ANIMATED);
    }
    /**
     * @return ImageType
     */
    public function flash()
    {
        return ImageType::fromValue(self::FLASH);
    }
    /**
     * @return ImageType
     */
    public function video()
    {
        return ImageType::fromValue(self::VIDEO);
    }
    /**
     * @return ImageType
     */
    public function html5()
    {
        return ImageType::fromValue(self::HTML5);
    }
}
