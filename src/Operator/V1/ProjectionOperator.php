<?php

namespace MyTarget\Operator\V1;

use MyTarget\Client;
use MyTarget\Domain\V1\Projection;
use MyTarget\Domain\V1\ProjectionCampaign;
use MyTarget\Mapper\Mapper;

class ProjectionOperator
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

    public function projection(ProjectionCampaign $campaign, array $context = null)
    {
        $data = $this->mapper->snapshot($campaign);

        $json = $this->client->post("/api/v1/projection.json", null, $data, $context);

        return $this->mapper->hydrateNew(Projection::class, $json);
    }
}
