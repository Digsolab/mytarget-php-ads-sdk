<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class VideoParams
{
    /**
     * @var bool
     * @Field(name="over_video", type="bool")
     */
    private $overVideo;

    /**
     * @var int
     * @Field(name="width", type="int")
     */
    private $width;

    /**
     * @var int
     * @Field(name="height", type="int")
     */
    private $height;

    /**
     * @var int
     * @Field(name="video_x", type="int")
     */
    private $videoX;

    /**
     * @var int
     * @Field(name="video_y", type="int")
     */
    private $videoY;

    /**
     * @var bool
     * @Field(name="loop", type="bool")
     */
    private $loop;

    /**
     * @var bool
     * @Field(name="sound_delay", type="bool")
     */
    private $soundDelay;

    /**
     * @var bool
     * @Field(name="autoplay", type="bool")
     */
    private $autoplay;
}
