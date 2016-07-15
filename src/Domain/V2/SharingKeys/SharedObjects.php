<?php

namespace MyTarget\Domain\V2\SharingKeys;

use MyTarget\Mapper\Annotation\Field;

class SharedObjects extends ShareObjects
{
    /**
     * @var ShareClient
     * @Field(type="MyTarget\Domain\V2\SharingKeys\ShareClient")
     */
    private $owner;

    /**
     * @var string
     * @Field(name="sharing_key", type="string")
     */
    private $sharingKey;

    /**
     * @var string
     * @Field(name="sharing_url", type="string")
     */
    private $sharingUrl;

    /**
     * @return string
     */
    public function getSharingUrl()
    {
        return $this->sharingUrl;
    }

    /**
     * @return string
     */
    public function getSharingKey()
    {
        return $this->sharingKey;
    }

    /**
     * @return ShareClient
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
