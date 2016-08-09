<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\AdditionalUserInfo;
use Dsl\MyTarget\Domain\V1\AgencyClient;
use Dsl\MyTarget\Mapper\Mapper;

class ClientOperator
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

    /**
     * @param array|null $context
     * @return AgencyClient[]
     */
    public function all(array $context = null)
    {
        $json = $this->client->get("/api/v1/clients.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(AgencyClient::class, $json);
        }, $json);
    }

    /**
     * @param AdditionalUserInfo $userInfo
     * @param array|null $context
     *
     * @return AgencyClient
     */
    public function create(AdditionalUserInfo $userInfo, array $context = null)
    {
        $rawUserInfo = $this->mapper->snapshot($userInfo);
        $body = ["additional_info" => $rawUserInfo];

        $json = $this->client->post("/api/v1/clients.json", null, $body, $context);

        return $this->mapper->hydrateNew(AgencyClient::class, $json);
    }
}
