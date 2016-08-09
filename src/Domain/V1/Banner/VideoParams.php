<?php

namespace Dsl\MyTarget\Domain\V1\Banner;

use Dsl\MyTarget\Mapper\Annotation\Field;

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

    /**
     * @param bool $overVideo
     * @param int $width
     * @param int $height
     * @param int $videoX
     * @param int $videoY
     * @param bool $loop
     * @param bool $soundDelay
     * @param bool $autoplay
     */
    public function __construct($overVideo, $width, $height, $videoX, $videoY, $loop, $soundDelay, $autoplay)
    {
        $this->overVideo = $overVideo;
        $this->width = $width;
        $this->height = $height;
        $this->videoX = $videoX;
        $this->videoY = $videoY;
        $this->loop = $loop;
        $this->soundDelay = $soundDelay;
        $this->autoplay = $autoplay;
    }

    /**
     * @return bool
     */
    public function isOverVideo()
    {
        return $this->overVideo;
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
    public function getVideoX()
    {
        return $this->videoX;
    }

    /**
     * @return int
     */
    public function getVideoY()
    {
        return $this->videoY;
    }

    /**
     * @return bool
     */
    public function isLoop()
    {
        return $this->loop;
    }

    /**
     * @return bool
     */
    public function isSoundDelay()
    {
        return $this->soundDelay;
    }

    /**
     * @return bool
     */
    public function isAutoplay()
    {
        return $this->autoplay;
    }
}
