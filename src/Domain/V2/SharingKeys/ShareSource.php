<?php

namespace MyTarget\Domain\V2\SharingKeys;

use MyTarget\Mapper\Annotation\Field;

class ShareSource
{
    /**
     * @var string
     * @Field(name="object_type", type="string")
     */
    private $objectType;

    /**
     * @var int
     * @Field(name="object_id", type="int")
     */
    private $objectId;

    /**
     * @param string $objectType
     * @param int $objectId
     */
    public function __construct($objectType, $objectId)
    {
        $this->objectType = $objectType;
        $this->objectId = $objectId;
    }

    /**
     * @return string
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * @return int
     */
    public function getObjectId()
    {
        return $this->objectId;
    }
}
