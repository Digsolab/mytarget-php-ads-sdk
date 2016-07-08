<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;
use MyTarget\Domain\V1\Enum\LocalGeoLocType;
use MyTarget\Domain\V1\Enum\LocalGeoVisitType;

class LocalGeo
{
    /**
     * @var LocalGeoVisitType
     * @Field(name="type", type="MyTarget\Domain\V1\Enum\LocalGeoVisitType")
     */
    private $type;

    /**
     * @var Location[]
     * @Field(name="regions", type="array<MyTarget\Domain\V1\Location>")
     */
    private $regions;

    /**
     * @var LocalGeoLocType
     * @Field(name="loc_type", type="MyTarget\Domain\V1\Enum\LocalGeoLocType")
     */
    private $locType;
}
