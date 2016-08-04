<?php

namespace MyTarget\Domain\V1\Banner;

use MyTarget\Mapper\Annotation\Field;

class BannerModeration
{
    /**
     * @var string
     * @Field(name="comment", type="string")
     */
    private $comment;

    /**
     * @var string
     * @Field(name="reason", type="string")
     */
    private $reason;

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }
}
