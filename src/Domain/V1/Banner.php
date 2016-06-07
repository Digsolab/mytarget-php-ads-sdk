<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\V1\Enum\Status;
use MyTarget\Domain\V1\Enum\ModerationStatus;

class Banner extends AbstractHydratedObject
{
    /** @var int|null */
    private $id;

    /** @var Status|null */
    private $status;

    /** @var Status|null */
    private $systemStatus;

    /** @var \DateTime|null */
    private $created;

    /** @var \DateTime|null */
    private $updated;

    /** @var ModerationStatus|null */
    private $moderationStatus;

    /** @var string|null */
    private $title;

    /** @var string|null */
    private $text;

    /** @var string|null */
    private $telephone;

    /** @var string|null */
    private $companyName;

    /** @var string|null */
    private $url;

    /** @var string[]|null */
    private $urlTypes;

    /** @var string|null */
    private $jsonUrl;

    /** @var string|null */
    private $editUrl;

    /** @var string|null */
    private $previewImageUrl;

    /** @var User|null */
    private $user;

    /** @var Campaign|null */
    private $campaign;

    /** @var string|null */
    private $category;

    /** @var string|null */
    private $moderationReasonDisplay;

    /** @var string|null */
    private $moderationReasonsDisplay;

    /** @var BannerModeration|null */
    private $bannerModeration;

    /** @var Image|null */
    private $image;

    /** @var string|null */
    private $urlObjectId;

    /** @var Image|null */
    private $promoImage;

    /** @var Image|null */
    private $backgroundImage;

    /** @var Html|null */
    private $html5;

    /** @var VideoParams|null */
    private $videoParams;

    /** @var Products|null */
    private $products;

    /** @var string[]|null */
    private $bannerFields;

    /** @var mixed|null */
    private $links;

    /** @var mixed|null */
    private $pixels;

    /** @var string|null */
    private $deeplink;

    /** @var string|null */
    private $callToAction;
}
