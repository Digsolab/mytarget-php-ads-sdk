<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\V1\Enum\Status;
use MyTarget\Mapper\Annotation\Field;

class AgencyClient
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(type="string")
     */
    private $username;

    /**
     * @var Status
     * @Field(type="MyTarget\Domain\V1\Enum\Status")
     */
    private $status;

    /**
     * @var AdditionalUserInfo
     * @Field(name="additional_info", type="MyTarget\Domain\V1\AdditionalUserInfo")
     */
    private $additionalInfo;

    /**
     * @var UserAccount
     * @Field(type="MyTarget\Domain\V1\UserAccount")
     */
    private $account;

    /**
     * @var bool
     * @Field(name="is_red_client", type="bool")
     */
    private $isRedClient;

    /**
     * @var bool
     * @Field(name="is_msk_client", type="bool")
     */
    private $isMskAllowed;

    /**
     * @var bool
     * @Field(name="is_spb_client", type="bool")
     */
    private $isSpbAllowed;

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
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    /**
     * @return UserAccount
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return bool
     */
    public function isRedClient()
    {
        return $this->isRedClient;
    }

    /**
     * @return bool
     */
    public function isMskAllowed()
    {
        return $this->isMskAllowed;
    }

    /**
     * @return bool
     */
    public function isSpbAllowed()
    {
        return $this->isSpbAllowed;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param Status $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param AdditionalUserInfo $additionalInfo
     */
    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * @param UserAccount $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @param bool $isRedClient
     */
    public function setIsRedClient($isRedClient)
    {
        $this->isRedClient = $isRedClient;
    }

    /**
     * @param bool $isMskAllowed
     */
    public function setIsMskAllowed($isMskAllowed)
    {
        $this->isMskAllowed = $isMskAllowed;
    }

    /**
     * @param bool $isSpbAllowed
     */
    public function setIsSpbAllowed($isSpbAllowed)
    {
        $this->isSpbAllowed = $isSpbAllowed;
    }
}
