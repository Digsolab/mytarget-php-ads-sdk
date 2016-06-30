<?php

namespace MyTarget\Domain\V1\Pad;

use MyTarget\Domain\V1\Enum\ImageType;

class PadFilter
{
    /** @var int[] */
    private $allowMobileAndroidCategory;

    /** @var int[] */
    private $allowMobileCategory;

    /** @var int[] */
    private $allowMobileApps;

    /** @var ImageType[] */
    private $allowImageTypes;

    /** @var string[] */
    private $allowTopics;

    /** @var string[] */
    private $allowPadUrl;

    /** @var int[] */
    private $denyMobileAndroidCategory;

    /** @var int[] */
    private $denyMobileCategory;

    /** @var int[] */
    private $denyMobileApps;

    /** @var ImageType[] */
    private $denyImageTypes;

    /** @var string[] */
    private $denyTopics;

    /** @var string[] */
    private $denyPadUrl;
}
