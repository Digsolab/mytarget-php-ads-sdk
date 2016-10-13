<?php

namespace Dsl\MyTarget\Operator\V2;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V2\Campaign\Projection\Projection;
use Dsl\MyTarget\Domain\V2\Campaign\Projection\ProjectionCampaign;
use Dsl\MyTarget\Mapper\Mapper;

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

    /**
     * @param ProjectionCampaign $campaign
     * @param array|null $context
     * @return Projection
     */
    public function projection(ProjectionCampaign $campaign, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "projection2"];
        $data = $this->mapper->snapshot($campaign);

        $json = $this->client->post($this->getEndpoint(), null, $data, $context);

        return $this->mapper->hydrateNew(Projection::class, $json);
    }

    public function getEndpoint()
    {
        return "/api/v2/projection.json";
    }
}
