<?php

namespace MyTarget\Domain\V1\Pad;

use MyTarget\Mapper\Annotation\Field;

class PadGroup
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="url", type="string")
     */
    private $url;

    /**
     * @var string
     * @Field(name="description", type="string")
     */
    private $description;

    /**
     * @var string
     * @Field(name="status", type="string")
     */
    private $status;

    /**
     * @var int
     * @Field(name="platform_id", type="int")
     */
    private $platformId;

    /**
     * @var PadForPadGroup[]
     * @Field(name="pads", type="array<MyTarget\Domain\V1\Pad\PadForPadGroup>")
     */
    private $pads;

    /**
     * @var string
     * @Field(name="moderation_status", type="string")
     */
    private $moderationStatus;

    /**
     * @var string
     * @Field(name="moderation_reason_display", type="string")
     */
    private $moderationReasonDisplay;
}
