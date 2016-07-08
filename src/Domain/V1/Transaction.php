<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

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
}
