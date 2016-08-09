<?php

namespace Dsl\MyTarget\Domain\V1\Targeting\Pad;

use Dsl\MyTarget\Mapper\Annotation\Field;
use Dsl\MyTarget\Domain\V1\Enum\ImageType;

class PadFilter
{
    /**
     * @var int[]
     * @Field(name="allow_mobile_android_category", type="array<int>")
     */
    private $allowMobileAndroidCategory;

    /**
     * @var int[]
     * @Field(name="allow_mobile_category", type="array<int>")
     */
    private $allowMobileCategory;

    /**
     * @var int[]
     * @Field(name="allow_mobile_apps", type="array<int>")
     */
    private $allowMobileApps;

    /**
     * @var ImageType[]
     * @Field(name="allow_image_types", type="array<Dsl\MyTarget\Domain\V1\Enum\ImageType>")
     */
    private $allowImageTypes;

    /**
     * @var string[]
     * @Field(name="allow_topics", type="array<string>")
     */
    private $allowTopics;

    /**
     * @var string[]
     * @Field(name="allow_pad_url", type="array<string>")
     */
    private $allowPadUrl;

    /**
     * @var int[]
     * @Field(name="deny_mobile_android_category", type="array<int>")
     */
    private $denyMobileAndroidCategory;

    /**
     * @var int[]
     * @Field(name="deny_mobile_category", type="array<int>")
     */
    private $denyMobileCategory;

    /**
     * @var int[]
     * @Field(name="deny_mobile_apps", type="array<int>")
     */
    private $denyMobileApps;

    /**
     * @var ImageType[]
     * @Field(name="deny_image_types", type="array<Dsl\MyTarget\Domain\V1\Enum\ImageType>")
     */
    private $denyImageTypes;

    /**
     * @var string[]
     * @Field(name="deny_topics", type="array<string>")
     */
    private $denyTopics;

    /**
     * @var string[]
     * @Field(name="deny_pad_url", type="array<string>")
     */
    private $denyPadUrl;

    /**
     * @return int[]
     */
    public function getAllowMobileAndroidCategory()
    {
        return $this->allowMobileAndroidCategory;
    }

    /**
     * @return int[]
     */
    public function getAllowMobileCategory()
    {
        return $this->allowMobileCategory;
    }

    /**
     * @return int[]
     */
    public function getAllowMobileApps()
    {
        return $this->allowMobileApps;
    }

    /**
     * @return ImageType[]
     */
    public function getAllowImageTypes()
    {
        return $this->allowImageTypes;
    }

    /**
     * @return string[]
     */
    public function getAllowTopics()
    {
        return $this->allowTopics;
    }

    /**
     * @return string[]
     */
    public function getAllowPadUrl()
    {
        return $this->allowPadUrl;
    }

    /**
     * @return int[]
     */
    public function getDenyMobileAndroidCategory()
    {
        return $this->denyMobileAndroidCategory;
    }

    /**
     * @return int[]
     */
    public function getDenyMobileCategory()
    {
        return $this->denyMobileCategory;
    }

    /**
     * @return int[]
     */
    public function getDenyMobileApps()
    {
        return $this->denyMobileApps;
    }

    /**
     * @return ImageType[]
     */
    public function getDenyImageTypes()
    {
        return $this->denyImageTypes;
    }

    /**
     * @return string[]
     */
    public function getDenyTopics()
    {
        return $this->denyTopics;
    }

    /**
     * @return string[]
     */
    public function getDenyPadUrl()
    {
        return $this->denyPadUrl;
    }

    /**
     * @param int[] $allowMobileAndroidCategory
     */
    public function setAllowMobileAndroidCategory($allowMobileAndroidCategory)
    {
        $this->allowMobileAndroidCategory = $allowMobileAndroidCategory;
    }

    /**
     * @param int[] $allowMobileCategory
     */
    public function setAllowMobileCategory($allowMobileCategory)
    {
        $this->allowMobileCategory = $allowMobileCategory;
    }

    /**
     * @param int[] $allowMobileApps
     */
    public function setAllowMobileApps($allowMobileApps)
    {
        $this->allowMobileApps = $allowMobileApps;
    }

    /**
     * @param ImageType[] $allowImageTypes
     */
    public function setAllowImageTypes($allowImageTypes)
    {
        $this->allowImageTypes = $allowImageTypes;
    }

    /**
     * @param string[] $allowTopics
     */
    public function setAllowTopics($allowTopics)
    {
        $this->allowTopics = $allowTopics;
    }

    /**
     * @param string[] $allowPadUrl
     */
    public function setAllowPadUrl($allowPadUrl)
    {
        $this->allowPadUrl = $allowPadUrl;
    }

    /**
     * @param int[] $denyMobileAndroidCategory
     */
    public function setDenyMobileAndroidCategory($denyMobileAndroidCategory)
    {
        $this->denyMobileAndroidCategory = $denyMobileAndroidCategory;
    }

    /**
     * @param int[] $denyMobileCategory
     */
    public function setDenyMobileCategory($denyMobileCategory)
    {
        $this->denyMobileCategory = $denyMobileCategory;
    }

    /**
     * @param int[] $denyMobileApps
     */
    public function setDenyMobileApps($denyMobileApps)
    {
        $this->denyMobileApps = $denyMobileApps;
    }

    /**
     * @param ImageType[] $denyImageTypes
     */
    public function setDenyImageTypes($denyImageTypes)
    {
        $this->denyImageTypes = $denyImageTypes;
    }

    /**
     * @param string[] $denyTopics
     */
    public function setDenyTopics($denyTopics)
    {
        $this->denyTopics = $denyTopics;
    }

    /**
     * @param string[] $denyPadUrl
     */
    public function setDenyPadUrl($denyPadUrl)
    {
        $this->denyPadUrl = $denyPadUrl;
    }
}
