<?php

namespace MyTarget\Domain\V1;

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
     * @var bool
     * @Field(name="is_animated", type="bool")
     */
    private $isAnimated;

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

    /**
     * @return bool
     */
    public function isAnimated()
    {
        return $this->isAnimated;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @param bool $isAnimated
     */
    public function setIsAnimated($isAnimated)
    {
        $this->isAnimated = $isAnimated;
    }
}
