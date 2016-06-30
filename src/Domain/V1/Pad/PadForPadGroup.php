<?php

namespace MyTarget\Domain\V1\Pad;

use MyTarget\Mapper\Annotation\Field;

class PadForPadGroup
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

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
     * @Field(name="format_id", type="int")
     */
    private $formatId;

    /**
     * @var int
     * @Field(name="shows_limit", type="int")
     */
    private $showsLimit;

    /**
     * @var string
     * @Field(name="shows_period", type="string")
     */
    private $showsPeriod;

    /**
     * @var int
     * @Field(name="shows_interval", type="int")
     */
    private $showsInterval;

    /**
     * @var PadFilter
     * @Field(name="filters", type="MyTarget\Domain\V1\Pad\PadFilter")
     */
    private $filters;

    /**
     * @var int
     * @Field(name="block_cpm_limit", type="int")
     */
    private $blockCpmLimit;

    /**
     * @var bool
     * @Field(name="js_tag", type="bool")
     */
    private $jsTag;
}
