<?php

namespace MyTarget\Operator\V1\Remarketing;

use MyTarget\Client;
use MyTarget\Mapper\Mapper;

class RemarketingVkGroupsOperator
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Mapper
     */
    private $mapper;

    public function __construct(Client $client, Mapper $mapper)
    {
        $this->client = $client;
        $this->mapper = $mapper;
    }

    public function all()
    {

    }
}
