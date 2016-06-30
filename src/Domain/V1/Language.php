<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class Language
{
    /**
     * @var string[]
     * @Field(name="english", type="array<string")
     */
    private $english;

    /**
     * @var string[]
     * @Field(name="french", type="array<string>")
     */
    private $french;

    /**
     * @var string[]
     * @Field(name="german", type="array<string>")
     */
    private $german;
}
