<?php

namespace Dsl\MyTarget\Domain\V1\Image;

use Dsl\MyTarget\Mapper\Annotation\Field;

class UploadImage
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
     * @var int
     * @Field(type="int", name="banner_format_id")
     */
    private $bannerFormatId;

    /**
     * @var int
     * @Field(type="int", name="y1")
     */
    private $top;

    /**
     * @var int
     * @Field(type="int", name="y2")
     */
    private $bottom;

    /**
     * @var int
     * @Field(type="int", name="x1")
     */
    private $left;

    /**
     * @var int
     * @Field(type="int", name="x2")
     */
    private $right;

    /**
     * @param int $bannerFormatId
     * @return UploadImage
     */
    public static function forFormat($bannerFormatId)
    {
        $self = new UploadImage();
        $self->bannerFormatId = $bannerFormatId;

        return $self;
    }

    /**
     * @param int $width
     * @param int $height
     * @return UploadImage
     */
    public static function forDimensions($width, $height)
    {
        $self = new UploadImage();
        $self->width = $width;
        $self->height = $height;

        return $self;
    }

    /**
     * @param int $top
     * @param int $right
     * @param int $bottom
     * @param int $left
     * @return UploadImage
     */
    public function crop($top, $right, $bottom, $left)
    {
        $self = new UploadImage();
        $self->top = $top;
        $self->right = $right;
        $self->bottom = $bottom;
        $self->left = $left;

        return $self;
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
     * @return int
     */
    public function getBannerFormatId()
    {
        return $this->bannerFormatId;
    }

    /**
     * @return int
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * @return int
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * @return int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @return int
     */
    public function getRight()
    {
        return $this->right;
    }
}
