<?php

namespace MyTarget\Domain\V1\Remarketing;

use MyTarget\Domain\V1\Enum\RemarketingAppType;
use MyTarget\Mapper\Annotation\Field;

class RemarketingApp
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="app_id", type="string")
     */
    private $appId;

    /**
     * @var RemarketingAppType
     * @Field(name="app_type", type="MyTarget\Domain\V1\Enum\RemarketingAppType")
     */
    private $appType;

    /**
     * @param string $appId
     * @param RemarketingAppType $appType
     */
    public function __construct($appId, RemarketingAppType $appType)
    {
        $this->appId = $appId;
        $this->appType = $appType;
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
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return RemarketingAppType
     */
    public function getAppType()
    {
        return $this->appType;
    }
}
