<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;
use MyTarget\Domain\V1\Enum\Status;
use MyTarget\Domain\V1\Enum\ModerationStatus;

class Banner
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var Status
     * @Field(name="status", type="MyTarget\Domain\V1\Enum\Status")
     */
    private $status;

    /**
     * @var Status
     * @Field(name="system_status", type="MyTarget\Domain\V1\Enum\Status")
     */
    private $systemStatus;

    /**
     * @var \DateTime
     * @Field(name="created", type="DateTime")
     */
    private $created;

    /**
     * @var \DateTime
     * @Field(name="updated", type="DateTime")
     */
    private $updated;

    /**
     * @var ModerationStatus
     * @Field(name="moderation_status", type="MyTarget\Domain\V1\Enum\ModerationStatus")
     */
    private $moderationStatus;

    /**
     * @var string
     * @Field(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     * @Field(name="text", type="string")
     */
    private $text;

    /**
     * @var string
     * @Field(name="telephone", type="string")
     */
    private $telephone;

    /**
     * @var string
     * @Field(name="company_name", type="string")
     */
    private $companyName;

    /**
     * @var string
     * @Field(name="url", type="string")
     */
    private $url;

    /**
     * @var string[]
     * @Field(name="url_types", type="array<string>")
     */
    private $urlTypes;

    /**
     * @var string
     * @Field(name="json_url", type="string")
     */
    private $jsonUrl;

    /**
     * @var string
     * @Field(name="edit_url", type="string")
     */
    private $editUrl;

    /**
     * @var string
     * @Field(name="preview_image_url", type="string")
     */
    private $previewImageUrl;

    /**
     * @var User
     * @Field(name="user", type="MyTarget\Domain\V1\User")
     */
    private $user;

    /**
     * @var Campaign
     * @Field(name="campaign", type="MyTarget\Domain\V1\Campaign")
     */
    private $campaign;

    /**
     * @var string
     * @Field(name="category", type="string")
     */
    private $category;

    /**
     * @var string
     * @Field(name="moderation_reason_display", type="string")
     */
    private $moderationReasonDisplay;

    /**
     * @var string
     * @Field(name="moderation_reasons_display", type="array<string>")
     */
    private $moderationReasonsDisplay;

    /**
     * @var BannerModeration
     * @Field(name="banner_moderation", type="MyTarget\Domain\V1\BannerModeration")
     */
    private $bannerModeration;

    /**
     * @var Image
     * @Field(name="image", type="MyTarget\Domain\V1\Image")
     */
    private $image;

    /**
     * @var string
     * @Field(name="url_object_id", type="string")
     */
    private $urlObjectId;

    /**
     * @var Image
     * @Field(name="promo_image", type="MyTarget\Domain\V1\Image")
     */
    private $promoImage;

    /**
     * @var Image
     * @Field(name="background_image", type="MyTarget\Domain\V1\Image")
     */
    private $backgroundImage;

    /**
     * @var Html
     * @Field(name="html5", type="MyTarget\Domain\V1\Html")
     */
    private $html5;

    /**
     * @var VideoParams
     * @Field(name="video_params", type="MyTarget\Domain\V1\VideoParams")
     */
    private $videoParams;

    /**
     * @var Products
     * @Field(name="products", type="MyTarget\Domain\V1\Products")
     */
    private $products;

    /**
     * @var string[]
     * @Field(name="banner_fields", type="array<string>")
     */
    private $bannerFields;

    /**
     * @var mixed
     * @Field(name="links", type="pass")
     */
    private $links;

    /**
     * @var mixed
     * @Field(name="pixels", type="mixed")
     */
    private $pixels;

    /**
     * @var string
     * @Field(name="deeplink", type="string")
     */
    private $deeplink;

    /**
     * @var string
     * @Field(name="call_to_action", type="string")
     */
    private $callToAction;
}
