<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class Language extends AbstractEnum
{
    const EN = 'en';
    const RU = 'ru';

    /**
     * @return Language
     */
    public static function en()
    {
        return ImageType::fromValue(self::EN);
    }

    /**
     * @return Language
     */
    public static function ru()
    {
        return ImageType::fromValue(self::RU);
    }
}
