<?php

namespace Dsl\MyTarget\Operator\V1\Fields;

use Dsl\MyTarget\Operator\AbstractFields;

class UserApiFields extends AbstractFields
{
    /**
     * @method UserApiFields withId()
     * @method UserApiFields withUsername()
     * @method UserApiFields withFirstName()
     * @method UserApiFields withLastName()
     * @method UserApiFields withEmail()
     * @method UserApiFields withStatus()
     * @method UserApiFields withAdditionalInfo()
     * @method UserApiFields withMailings()
     * @method UserApiFields withPermissions()
     * @method UserApiFields withAccount()
     * @method UserApiFields withAgency()
     * @method UserApiFields withAppendUtm()
     * @method UserApiFields withShowCompactView()
     * @method UserApiFields withInfoCurrency()
     * @method UserApiFields withCurrency()
     * @method UserApiFields withTypes()
     * @method UserApiFields withPartnerApproved()
     * @method UserApiFields withLanguage()
     */

    public function defaultFields()
    {
        return [
            'id', 'username', 'firstName', 'lastName', 'email', 'status',
            'additionalInfo', 'mailings', 'permissions', 'account', 'agency',
            'appendUtm', 'showCompactView', 'infoCurrency', 'currency',
            'types', 'isPartnerApproved', 'language'
        ];
    }
}
