<?php

namespace Dsl\MyTarget\Operator\V2;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V2\Campaign\Projection\Projection;
use Dsl\MyTarget\Domain\V2\Campaign\Projection\ProjectionSettings;
use Dsl\MyTarget\Mapper\Mapper;

class ProjectionOperator
{
    const LIMIT_PROJECTION = "v2-projection";

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
     * @param ProjectionSettings $campaign
     * @param Context|null       $context
     *
     * @return Projection
     */
    public function projection(ProjectionSettings $campaign, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_PROJECTION);
        $data = $this->mapper->snapshot($campaign);

        $json = $this->client->post("/api/v2/projection.json", null, $data, $context);

        return $this->mapper->hydrateNew(Projection::class, $json);
    }
}
