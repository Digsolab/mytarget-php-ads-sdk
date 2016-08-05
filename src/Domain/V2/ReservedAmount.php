<?php

namespace Dsl\MyTarget\Domain\V2;

use Dsl\MyTarget\Mapper\Annotation\Field;

class ReservedAmount
{
    /**
     * @var string
     * @Field(type="string")
     */
    private $balance;

    /**
     * @var string
     * @Field(type="string")
     */
    private $hold;

    /**
     * @var int
     * @Field(name="user_id", type="int")
     */
    private $userId;

    /**
     * @var string
     * @Field(type="string")
     */
    private $credit;

    /**
     * @param string $balance
     * @param string $hold
     * @param int $userId
     * @param string $credit
     */
    public function __construct($balance, $hold, $userId, $credit)
    {
        $this->balance = $balance;
        $this->hold = $hold;
        $this->userId = $userId;
        $this->credit = $credit;
    }

    /**
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param string $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getHold()
    {
        return $this->hold;
    }

    /**
     * @param string $hold
     */
    public function setHold($hold)
    {
        $this->hold = $hold;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @param string $credit
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    }
}
