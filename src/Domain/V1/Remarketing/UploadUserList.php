<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Mapper\Annotation\Field;

class UploadUserList
{
    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var string
     * @Field(type="string")
     */
    private $type;

    /**
     * @var int
     * @Field(type="int")
     */
    private $base;

    /**
     * @param string $name
     * @param string $type
     * @param int $base
     */
    public function __construct($name, $type, $base = 0)
    {
        $this->name = $name;
        $this->type = $type;
        $this->base = $base;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getBase()
    {
        return $this->base;
    }
}
