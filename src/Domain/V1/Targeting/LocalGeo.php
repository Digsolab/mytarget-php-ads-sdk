<?php

namespace MyTarget\Domain\V1\Targeting;


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
     * @Field(name="regions", type="array<\MyTarget\Domain\V1\Targeting\Location>")
     */
    private $regions;

    /**
     * @var LocalGeoLocType
     * @Field(name="loc_type", type="MyTarget\Domain\V1\Enum\LocalGeoLocType")
     */
    private $locType;

    /**
     * @param LocalGeoVisitType $type
     * @param Location[] $regions
     * @param LocalGeoLocType $locType
     */
    public function __construct(LocalGeoVisitType $type, array $regions, LocalGeoLocType $locType)
    {
        $this->type = $type;
        $this->regions = $regions;
        $this->locType = $locType;
    }

    /**
     * @return LocalGeoVisitType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Location[]
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * @return LocalGeoLocType
     */
    public function getLocType()
    {
        return $this->locType;
    }
}
