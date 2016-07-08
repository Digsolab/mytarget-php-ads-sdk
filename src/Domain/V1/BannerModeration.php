<?php

namespace MyTarget\Domain\V1;

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
}
