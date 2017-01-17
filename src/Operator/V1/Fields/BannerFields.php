<?php

namespace Dsl\MyTarget\Operator\V1\Fields;

use Dsl\MyTarget\Operator\AbstractFields;

/**
 * @method BannerFields withId()
 * @method BannerFields withStatus()
 * @method BannerFields withSystemStatus()
 * @method BannerFields withCreated()
 * @method BannerFields withUpdated()
 * @method BannerFields withModerationStatus()
 * @method BannerFields withTitle()
 * @method BannerFields withText()
 * @method BannerFields withTelephone()
 * @method BannerFields withCompanyName()
 * @method BannerFields withUrl()
 * @method BannerFields withUrlTypes()
 * @method BannerFields withJsonUrl()
 * @method BannerFields withEditUrl()
 * @method BannerFields withPreviewImageUrl()
 * @method BannerFields withUser()
 * @method BannerFields withCampaign()
 * @method BannerFields withCategory()
 * @method BannerFields withModerationReasonDisplay()
 * @method BannerFields withModerationReasonsDisplay()
 * @method BannerFields withAutomoderationReasonDisplay()
 * @method BannerFields withBannerModeration()
 * @method BannerFields withImage()
 * @method BannerFields withUrlObjectId()
 * @method BannerFields withPromoImage()
 * @method BannerFields withBackgroundImage()
 * @method BannerFields withHtml5()
 * @method BannerFields withVideoParams()
 * @method BannerFields withProducts()
 * @method BannerFields withBannerFields()
 * @method BannerFields withLinks()
 * @method BannerFields withPixels()
 * @method BannerFields withDeeplink()
 * @method BannerFields withCallToAction()
 * @method BannerFields withContent()
 * @method BannerFields withVkFeed()
 */
class BannerFields extends AbstractFields
{
    /**
     * @return BannerFields
     */
    public static function fastFields()
    {
        $fields = new BannerFields();
        $fields->addFields(['id', 'status', 'systemStatus', 'moderationStatus', 'created', 'updated']);

        return $fields;
    }

    public function defaultFields()
    {
        return ['id', 'status', 'systemStatus', 'created', 'updated', 'moderationStatus', 'title',
            'text', 'telephone', 'companyName', 'url', 'urlTypes', 'jsonUrl', 'editUrl', 'previewImageUrl',
            'user', 'campaign', 'category', 'moderationReasonDisplay', 'moderationReasonsDisplay', 'bannerModeration',
            'automoderationReasonDisplay', 'image', 'urlObjectId', 'promoImage', 'vkFeed', 'backgroundImage', 'html5',
            'videoParams', 'products', 'bannerFields', 'links', 'pixels', 'deeplink',
            'callToAction', 'content'];
    }
}
