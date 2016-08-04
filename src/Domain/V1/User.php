<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;
use MyTarget\Domain\V1\Enum\Mailing;
use MyTarget\Domain\V1\Enum\Status;

class User
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
     * @var string[]
     * @Field(name="types", type="array<string>")
     */
    private $types;

    /**
     * @var Status
     * @Field(name="status", type="MyTarget\Domain\V1\Enum\Status")
     */
    private $status;

    /**
     * @var AdditionalUserInfo
     * @Field(name="additional_info", type="MyTarget\Domain\V1\AdditionalUserInfo")
     */
    private $additionalInfo;

    /**
     * @var Mailing[]
     * @Field(name="mailings", type="array<MyTarget\Domain\V1\Enum\Mailing>")
     */
    private $mailings;

    /**
     * @var mixed
     * @Field(name="permissions", type="mixed")
     */
    private $permissions;

    /**
     * @var UserAccount
     * @Field(name="account", type="MyTarget\Domain\V1\UserAccount")
     */
    private $account;

    /**
     * @var Agency
     * @Field(name="agency", type="MyTarget\Domain\V1\Agency")
     */
    private $agency;

    /**
     * @var string
     * @Field(name="agency_username", type="string")
     */
    private $agencyUsername;

    /**
     * @var string
     * @Field(name="branch_username", type="string")
     */
    private $branchUsername;

    /**
     * @var int
     * @Field(name="bf", type="int")
     */
    private $bf;

    /**
     * @var string[]
     * @Field(name="flags", type="array<string>")
     */
    private $flags;

    /**
     * @var int
     * @Field(name="max_active_banners_count", type="int")
     */
    private $maxActiveBannersCount;

    /**
     * @var int
     * @Field(name="active_banners_count", type="int")
     */
    private $activeBannersCount;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \string[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param \string[] $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
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
     * @return Enum\Mailing[]
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
     * @param mixed $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @return UserAccount
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param UserAccount $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return Agency
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * @param Agency $agency
     */
    public function setAgency($agency)
    {
        $this->agency = $agency;
    }

    /**
     * @return string
     */
    public function getAgencyUsername()
    {
        return $this->agencyUsername;
    }

    /**
     * @param string $agencyUsername
     */
    public function setAgencyUsername($agencyUsername)
    {
        $this->agencyUsername = $agencyUsername;
    }

    /**
     * @return string
     */
    public function getBranchUsername()
    {
        return $this->branchUsername;
    }

    /**
     * @param string $branchUsername
     */
    public function setBranchUsername($branchUsername)
    {
        $this->branchUsername = $branchUsername;
    }

    /**
     * @return int
     */
    public function getBf()
    {
        return $this->bf;
    }

    /**
     * @param int $bf
     */
    public function setBf($bf)
    {
        $this->bf = $bf;
    }

    /**
     * @return \string[]
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param \string[] $flags
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }

    /**
     * @return int
     */
    public function getMaxActiveBannersCount()
    {
        return $this->maxActiveBannersCount;
    }

    /**
     * @param int $maxActiveBannersCount
     */
    public function setMaxActiveBannersCount($maxActiveBannersCount)
    {
        $this->maxActiveBannersCount = $maxActiveBannersCount;
    }

    /**
     * @return int
     */
    public function getActiveBannersCount()
    {
        return $this->activeBannersCount;
    }

    /**
     * @param int $activeBannersCount
     */
    public function setActiveBannersCount($activeBannersCount)
    {
        $this->activeBannersCount = $activeBannersCount;
    }

    /**
     * @return bool
     */
    public function isAppendUtm()
    {
        return $this->appendUtm;
    }

    /**
     * @param bool $appendUtm
     */
    public function setAppendUtm($appendUtm)
    {
        $this->appendUtm = $appendUtm;
    }

    /**
     * @return bool
     */
    public function isShowCompactView()
    {
        return $this->showCompactView;
    }

    /**
     * @param bool $showCompactView
     */
    public function setShowCompactView($showCompactView)
    {
        $this->showCompactView = $showCompactView;
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
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}
