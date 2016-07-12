<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class LocalGeoLocType extends AbstractEnum
{
    const ALL = 'all';
    const HOME = 'home';
    const WORK = 'work';

    /**
     * @return LocalGeoLocType
     */
    public function all()
    {
        return LocalGeoLocType::fromValue(self::ALL);
    }

    /**
     * @return LocalGeoLocType
     */
    public function home()
    {
        return LocalGeoLocType::fromValue(self::HOME);
    }

    /**
     * @return LocalGeoLocType
     */
    public function work()
    {
        return LocalGeoLocType::fromValue(self::WORK);
    }
}
