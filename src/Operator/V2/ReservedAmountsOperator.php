<?php

namespace Dsl\MyTarget\Operator\V2;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V2\ReservedAmount;
use Dsl\MyTarget\Mapper\Mapper;

class ReservedAmountsOperator
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
     * @param int $clientId
     * @param array|null $context
     *
     * @return ReservedAmount[]
     */
    public function find($clientId, array $context = null)
    {
        $uri = sprintf("/api/v2/reserved_amounts/%d.json", $clientId);
        $json = $this->client->get($uri, null, $context);

        if (isset($json["reserved_amounts"])) {
            return array_map(function ($json) {
                return $this->mapper->hydrateNew(ReservedAmount::class, $json);
            }, $json["reserved_amounts"]);
        }

        return [];
    }
}
