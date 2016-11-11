<?php

namespace Dsl\MyTarget\Domain\V1\Banner;

use Dsl\MyTarget\Mapper\Annotation\Field;

class BannerModeration
{
    /**
     * @var string
     * @Field(name="moderation_comment", type="string")
     */
    private $comment;

    /**
     * @var string
     * @Field(name="moderation_reason", type="string")
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
