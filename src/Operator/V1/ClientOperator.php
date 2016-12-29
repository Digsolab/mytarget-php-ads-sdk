<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\AdditionalUserInfo;
use Dsl\MyTarget\Domain\V1\AgencyClient;
use Dsl\MyTarget\Mapper\Mapper;

class ClientOperator
{
    const LIMIT_FIND = "client-find";
    const LIMIT_CREATE = "campaign-create";

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
     * @param Context|null $context
     * @return AgencyClient[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get("/api/v1/clients.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(AgencyClient::class, $json);
        }, $json);
    }

    /**
     * @param AdditionalUserInfo $userInfo
     * @param Context|null $context
     *
     * @return AgencyClient
     */
    public function create(AdditionalUserInfo $userInfo, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
        $rawUserInfo = $this->mapper->snapshot($userInfo);
        $body = ["additional_info" => $rawUserInfo];

        $json = $this->client->post("/api/v1/clients.json", null, $body, $context);

        return $this->mapper->hydrateNew(AgencyClient::class, $json);
    }
}
