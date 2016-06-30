<?php

namespace MyTarget\Domain\V1\Pad;

class PadGroup
{
    /** @var int */
    private $id;

    /** @var string */
    private $url;

    /** @var string */
    private $description;

    /** @var string */
    private $status;

    /** @var int */
    private $platformId;

    /** @var PadForPadGroup[] */
    private $pads;

    /** @var string */
    private $moderationStatus;

    /** @var string */
    private $moderationReasonDisplay;
}
