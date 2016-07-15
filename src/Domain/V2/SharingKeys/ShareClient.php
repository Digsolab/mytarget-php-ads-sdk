<?php

namespace MyTarget\Domain\V2\SharingKeys;

use MyTarget\Mapper\Annotation\Field;

class ShareClient
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
    private $username;

    /**
     * @param string $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
