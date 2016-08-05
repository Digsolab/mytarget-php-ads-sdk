<?php

namespace Dsl\MyTarget\Domain\V1;

use Dsl\MyTarget\Mapper\Annotation\Field;

class UserAccount
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(type="string")
     */
    private $balance;

    /**
     * @var string[]
     * @Field(type="array<string>")
     */
    private $flags;

    /**
     * @var string
     * @Field(type="string")
     */
    private $type;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param string $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return \string[]
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param \string[] $flags
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
