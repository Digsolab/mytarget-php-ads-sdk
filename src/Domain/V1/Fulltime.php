<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class Fulltime
{
    /**
     * @var int[]
     * @Field(name="sun", type="array<int>")
     */
    private $sun;

    /**
     * @var int[]
     * @Field(name="mon", type="array<int>")
     */
    private $mon;

    /**
     * @var int[]
     * @Field(name="tue", type="array<int>")
     */
    private $tue;

    /**
     * @var int[]
     * @Field(name="wed", type="array<int>")
     */
    private $wed;

    /**
     * @var int[]
     * @Field(name="thu", type="array<int>")
     */
    private $thu;

    /**
     * @var int[]
     * @Field(name="fri", type="array<int>")
     */
    private $fri;

    /**
     * @var int[]
     * @Field(name="sat", type="array<int>")
     */
    private $sat;

    /**
     * @var string[]
     * @Field(name="flags", type="array<string>")
     */
    private $flags;
}
