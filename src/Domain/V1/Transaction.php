<?php

namespace Dsl\MyTarget\Domain\V1;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Transaction
{
    /**
     * @var string
     * @Field(name="amount", type="string")
     */
    private $amount;

    /**
     * @var string
     * @Field(name="agency_balance", type="string")
     */
    private $agencyBalance;

    /**
     * @var string
     * @Field(name="client_balance", type="string")
     */
    private $clientBalance;

    /**
     * @var string
     * @Field(name="client_username", type="string")
     */
    private $clientUsername;

    /**
     * @var \DateTime
     * @Field(name="created_at", type="DateTime<H:m d.m.Y>")
     */
    private $createdAt;

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getAgencyBalance()
    {
        return $this->agencyBalance;
    }

    /**
     * @param string $agencyBalance
     */
    public function setAgencyBalance($agencyBalance)
    {
        $this->agencyBalance = $agencyBalance;
    }

    /**
     * @return string
     */
    public function getClientBalance()
    {
        return $this->clientBalance;
    }

    /**
     * @param string $clientBalance
     */
    public function setClientBalance($clientBalance)
    {
        $this->clientBalance = $clientBalance;
    }

    /**
     * @return string
     */
    public function getClientUsername()
    {
        return $this->clientUsername;
    }

    /**
     * @param string $clientUsername
     */
    public function setClientUsername($clientUsername)
    {
        $this->clientUsername = $clientUsername;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
