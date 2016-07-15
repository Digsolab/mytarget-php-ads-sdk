<?php

namespace MyTarget\Domain\V1\Targeting\Pad;


use MyTarget\Mapper\Annotation\Field;

class PadGroup
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
     * @var string
     * @Field(name="status", type="string")
     */
    private $status;

    /**
     * @var int
     * @Field(name="platform_id", type="int")
     */
    private $platformId;

    /**
     * @var PadForPadGroup[]
     * @Field(name="pads", type="array<MyTarget\Domain\V1\Targeting\Pad\PadForPadGroup>")
     */
    private $pads;

    /**
     * @var string
     * @Field(name="moderation_status", type="string")
     */
    private $moderationStatus;

    /**
     * @var string
     * @Field(name="moderation_reason_display", type="string")
     */
    private $moderationReasonDisplay;

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

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getPlatformId()
    {
        return $this->platformId;
    }

    /**
     * @return PadForPadGroup[]
     */
    public function getPads()
    {
        return $this->pads;
    }

    /**
     * @return string
     */
    public function getModerationStatus()
    {
        return $this->moderationStatus;
    }

    /**
     * @return string
     */
    public function getModerationReasonDisplay()
    {
        return $this->moderationReasonDisplay;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param int $platformId
     */
    public function setPlatformId($platformId)
    {
        $this->platformId = $platformId;
    }

    /**
     * @param PadForPadGroup[] $pads
     */
    public function setPads($pads)
    {
        $this->pads = $pads;
    }

    /**
     * @param string $moderationStatus
     */
    public function setModerationStatus($moderationStatus)
    {
        $this->moderationStatus = $moderationStatus;
    }

    /**
     * @param string $moderationReasonDisplay
     */
    public function setModerationReasonDisplay($moderationReasonDisplay)
    {
        $this->moderationReasonDisplay = $moderationReasonDisplay;
    }
}
