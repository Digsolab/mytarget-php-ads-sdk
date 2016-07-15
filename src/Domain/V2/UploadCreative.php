<?php

namespace MyTarget\Domain\V2;

use MyTarget\Mapper\Annotation\Field;

class UploadCreative
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $width;

    /**
     * @var int
     * @Field(type="int")
     */
    private $height;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }
}
