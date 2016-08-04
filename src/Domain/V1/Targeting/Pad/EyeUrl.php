<?php

namespace MyTarget\Domain\V1\Targeting\Pad;

use MyTarget\Mapper\Annotation\Field;

class EyeUrl
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="url", type="string")
     */
    private $url;

    /**
     * @var string
     * @Field(name="description", type="string")
     */
    private $description;

    /**
     * @param int $id
     * @param string $url
     * @param string $description
     */
    public function __construct($id, $url, $description)
    {
        $this->id = $id;
        $this->url = $url;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
