<?php

namespace Dsl\MyTarget\Domain\V1;

use Dsl\MyTarget\Mapper\Annotation\Field;
use Dsl\MyTarget\Domain\V1\Enum\Language;
use Dsl\MyTarget\Domain\V1\Enum\Mailing;
use Dsl\MyTarget\Domain\V1\Enum\Status;

class UserApi
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="username", type="string")
     */
    private $username;

    /**
     * @var string
     * @Field(name="firstname", type="string")
     */
    private $firstName;

    /**
     * @var string
     * @Field(name="lastname", type="string")
     */
    private $lastName;

    /**
     * @var string
     * @Field(name="email", type="string")
     */
    private $email;

    /**
     * @var Status
     * @Field(name="status", type="Dsl\MyTarget\Domain\V1\Enum\Status")
     */
    private $status;

    /**
     * @var AdditionalUserInfo
     * @Field(name="additional_info", type="Dsl\MyTarget\Domain\V1\AdditionalUserInfo")
     */
    private $additionalInfo;

    /**
     * @var Mailing[]
     * @Field(name="mailings", type="array<Dsl\MyTarget\Domain\V1\Enum\Mailing>")
     */
    private $mailings;

    /**
     * @var mixed
     * @Field(name="permissions", type="mixed")
     */
    private $permissions;

    /**
     * @var UserAccount
     * @Field(name="account", type="Dsl\MyTarget\Domain\V1\UserAccount")
     */
    private $account;

    /**
     * @var Agency
     * @Field(name="agency", type="Dsl\MyTarget\Domain\V1\Agency")
     */
    private $agency;

    /**
     * @var bool
     * @Field(name="append_utm", type="bool")
     */
    private $appendUtm;

    /**
     * @var bool
     * @Field(name="show_compact_view", type="bool")
     */
    private $showCompactView;

    /**
     * @var string
     * @Field(name="info_currency", type="string")
     */
    private $infoCurrency;

    /**
     * @var string
     * @Field(name="currency", type="string")
     */
    private $currency;

    /**
     * @var string[]
     * @Field(name="types", type="array<string>")
     */
    private $types;

    /**
     * @var bool
     * @Field(name="partner_is_approved", type="bool")
     */
    private $isPartnerApproved;

    /**
     * @var Language
     * @Field(name="language", type="Dsl\MyTarget\Domain\V1\Enum\Language")
     */
    private $language;

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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return AdditionalUserInfo
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    /**
     * @param AdditionalUserInfo $additionalInfo
     */
    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * @return Mailing[]
     */
    public function getMailings()
    {
        return $this->mailings;
    }

    /**
     * @param Enum\Mailing[] $mailings
     */
    public function setMailings($mailings)
    {
        $this->mailings = $mailings;
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @return UserAccount
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return Agency
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * @return bool
     */
    public function isAppendUtm()
    {
        return $this->appendUtm;
    }

    /**
     * @return bool
     */
    public function isShowCompactView()
    {
        return $this->showCompactView;
    }

    /**
     * @return string
     */
    public function getInfoCurrency()
    {
        return $this->infoCurrency;
    }

    /**
     * @param string $infoCurrency
     */
    public function setInfoCurrency($infoCurrency)
    {
        $this->infoCurrency = $infoCurrency;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return \string[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @return bool
     */
    public function isPartnerApproved()
    {
        return $this->isPartnerApproved;
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param Language $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
