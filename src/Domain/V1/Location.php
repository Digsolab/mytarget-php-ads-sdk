<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

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
}
