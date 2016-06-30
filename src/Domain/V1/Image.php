<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class Image
{
    /**
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @Field(name="height", type="int")
     */
    private $height;

    /**
     * @Field(name="width", type="int")
     */
    private $width;

    /**
     * @Field(name="size", type="int")
     */
    private $size;

    /**
     * @Field(name="is_animated", type="bool")
     */
    private $isAnimated;

    /**
     * @Field(name="type", type="string")
     */
    private $type;

    /**
     * @Field(name="url", type="string")
     */
    private $url;

    /**
     * @Field(name="preview_url", type="string")
     */
    private $previewUrl;
}
