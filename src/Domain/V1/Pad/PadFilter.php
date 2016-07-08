<?php

namespace MyTarget\Domain\V1\Pad;

use MyTarget\Mapper\Annotation\Field;
use MyTarget\Domain\V1\Enum\ImageType;

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
     * @Field(name="allow_image_types", type="array<ImageType>")
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
     * @Field(name="deny_image_types", type="array<ImageType>")
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
}
