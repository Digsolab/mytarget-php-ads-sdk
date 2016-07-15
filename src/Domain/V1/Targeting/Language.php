<?php

namespace MyTarget\Domain\V1\Targeting;

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

    /**
     * @param \string[] $english
     * @param \string[] $french
     * @param \string[] $german
     */
    public function __construct(array $english, array $french, array $german)
    {
        $this->english = $english;
        $this->french = $french;
        $this->german = $german;
    }

    /**
     * @return \string[]
     */
    public function getEnglish()
    {
        return $this->english;
    }

    /**
     * @return \string[]
     */
    public function getFrench()
    {
        return $this->french;
    }

    /**
     * @return \string[]
     */
    public function getGerman()
    {
        return $this->german;
    }
}
