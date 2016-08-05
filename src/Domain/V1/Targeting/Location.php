<?php

namespace Dsl\MyTarget\Domain\V1\Targeting;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Location
{
    /**
     * @var float
     * @Field(name="lng", type="float")
     */
    private $lng;

    /**
     * @var float
     * @Field(name="lat", type="float")
     */
    private $lat;

    /**
     * @var int
     * @Field(name="radius", type="int")
     */
    private $radius;

    /**
     * @var string
     * @Field(name="label", type="string")
     */
    private $label;

    /**
     * @param float $lng
     * @param float $lat
     * @param int $radius
     * @param string $label
     *
     * @return Location
     */
    public static function create($lng, $lat, $radius, $label)
    {
        $self = new Location();
        $self->lng = $lng;
        $self->lat = $lat;
        $self->radius = $radius;
        $self->label = $label;

        return $self;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return int
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param float $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @param float $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @param int $radius
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}
