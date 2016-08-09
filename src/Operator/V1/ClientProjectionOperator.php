<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Campaign\Projection\ProjectionCampaign;
use Dsl\MyTarget\Mapper\Mapper;

class ClientProjectionOperator extends ProjectionOperator
{
    /**
     * @var string
     */
    private $username;

    /**
     * @param string $username
     * @param Client $client
     * @param Mapper $mapper
     */
    public function __construct($username, Client $client, Mapper $mapper)
    {
        parent::__construct($client, $mapper);

        $this->username = $username;
    }

    public function projection(ProjectionCampaign $campaign, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::projection($campaign, $context);
    }
}
