<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\V1\Enum\LocalGeoLocType;
use MyTarget\Domain\V1\Enum\LocalGeoVisitType;

class LocalGeo
{
    /** @var LocalGeoVisitType */
    private $type;

    /** @var Location[] */
    private $regions;

    /** @var LocalGeoLocType */
    private $locType;
}
