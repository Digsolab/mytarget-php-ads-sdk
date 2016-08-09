<?php

namespace Dsl\MyTarget\Operator\V1\Fields;

use Dsl\MyTarget\Operator\AbstractFields;

/**
 * @method CampaignFields withId()
 * @method CampaignFields withName()
 * @method CampaignFields withStatus()
 * @method CampaignFields withSystemStatus()
 * @method CampaignFields withCreated()
 * @method CampaignFields withUpdated()
 * @method CampaignFields withDateStart()
 * @method CampaignFields withDateEnd()
 * @method CampaignFields withPackage()
 * @method CampaignFields withPricePerShow()
 * @method CampaignFields withPricePerClick()
 * @method CampaignFields withBudgetLimitDay()
 * @method CampaignFields withBudgetLimit()
 * @method CampaignFields withCrClicksLimit()
 * @method CampaignFields withCrShowsLimit()
 * @method CampaignFields withMixing()
 * @method CampaignFields withTargetings()
 * @method CampaignFields withUrl()
 * @method CampaignFields withEditUrl()
 * @method CampaignFields withBannersUrl()
 * @method CampaignFields withBannersCount()
 * @method CampaignFields withGroupMembers()
 * @method CampaignFields withAutoBiddingMode()
 * @method CampaignFields withAppendUtm()
 * @method CampaignFields withAgeRestrictions()
 * @method CampaignFields withPriceList()
 * @method CampaignFields withBanners()
 * @method CampaignFields withLastUpdated()
 * @method CampaignFields withExtendedAge()
 * @method CampaignFields withEnableRecombination()
 * @method CampaignFields withEnableUtm()
 * @method CampaignFields withUtm()
 * @method CampaignFields withUniqShowsLimit()
 * @method CampaignFields withUniqShowsPeriod()
 * @method CampaignFields withBannerUniqShowsLimit()
 * @method CampaignFields withAuditPixels()
 * @method CampaignFields withUrlObjectId()
 */
class CampaignFields extends AbstractFields
{
    const FIELD_BANNERS = 'banners';

    public function defaultFields()
    {
        return ['id', 'name', 'status', 'systemStatus', 'created', 'updated', 'dateStart', 'dateEnd', 'package',
            'pricePerShow', 'pricePerClick', 'budgetLimitDay', 'budgetLimit', 'crClicksLimit', 'crShowsLimit',
            'mixing', 'targetings', 'url', 'editUrl', 'bannersUrl', 'bannersCount', 'groupMembers', 'autoBiddingMode',
            'appendUtm', 'ageRestrictions', 'priceList', self::FIELD_BANNERS, 'lastUpdated', 'extendedAge',
            'enableRecombination', 'enableUtm', 'utm', 'uniqShowsLimit', 'uniqShowsPeriod', 'bannerUniqShowsLimit',
            'auditPixels', 'urlObjectId'];
    }
}
