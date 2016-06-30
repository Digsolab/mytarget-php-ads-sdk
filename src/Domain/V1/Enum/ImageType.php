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
}
