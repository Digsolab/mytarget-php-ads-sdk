<?php

namespace MyTarget\Operator\V1;

use MyTarget\Client;
use MyTarget\Domain\V1\AgencyClient;
use MyTarget\Mapper\Mapper;

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
     * @param AgencyClient $client
     * @param array|null $context
     *
     * @return AgencyClient
     */
    public function create(AgencyClient $client, array $context = null)
    {
        $rawClient = $this->mapper->snapshot($client);

        $json = $this->client->post("/api/v1/clients.json", null, $rawClient, $context);

        return $this->mapper->hydrateNew(AgencyClient::class, $json);
    }
}
