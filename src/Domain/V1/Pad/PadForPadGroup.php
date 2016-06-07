<?php

namespace MyTarget\Domain\V1\Pad;

class PadForPadGroup
{
    /** @var int */
    private $id;

    /** @var string */
    private $description;

    /** @var string */
    private $status;

    /** @var int */
    private $formatId;

    /** @var int */
    private $showsLimit;

    /** @var string */
    private $showsPeriod;

    /** @var int */
    private $showsInterval;

    /** @var PadFilter */
    private $filters;

    /** @var int */
    private $blockCpmLimit;

    /** @var bool */
    private $jsTag;
}
