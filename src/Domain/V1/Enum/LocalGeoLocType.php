<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class LocalGeoLocType extends AbstractEnum
{
    const ALL = 'all';
    const HOME = 'home';
    const WORK = 'work';
}
