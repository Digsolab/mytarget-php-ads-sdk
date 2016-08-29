<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Remarketing
{
    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var RemarketingItem[]
     * @Field(type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingItem>")
     */
    private $disjunctions;

    /**
     * @var string[]|null
     * @Field(type="array<string>")
     */
    private $flags;

    /**
     * @param string $name
     * @param RemarketingItem[] $disjunctions
     * @param array|null $flags
     */
    public function __construct($name, array $disjunctions, array $flags = null)
    {
        $this->name = $name;
        $this->disjunctions = $disjunctions;
        $this->flags = $flags;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return RemarketingItem[]
     */
    public function getDisjunctions()
    {
        return $this->disjunctions;
    }

    /**
     * @return string[]
     */
    public function getFlags()
    {
        return $this->flags;
    }
}
