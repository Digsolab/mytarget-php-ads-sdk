<?php

namespace MyTarget\Domain\V2;

use MyTarget\Mapper\Annotation\Field;

class CreativeVariant
{
    /**
     * @var string
     * @Field(type="string")
     */
    private $url;

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
     * @var int
     * @Field(type="int")
     */
    private $size;

    /**
     * @param string $url
     * @param int $width
     * @param int $height
     * @param int $size
     */
    public function __construct($url, $width, $height, $size)
    {
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
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

    /**
     * Returns size in bytes
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}
