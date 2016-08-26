<?php

namespace Dsl\MyTarget\Domain\V1;

use Dsl\MyTarget\Mapper\Annotation\Field;

class OdklGroup
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="title", type="string")
     */
    private $title;

    /**
     * @var int
     * @Field(name="participants", type="int")
     */
    private $participants;

    /**
     * @var string
     * @Field(name="url", type="string")
     */
    private $url;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

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
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param int $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
