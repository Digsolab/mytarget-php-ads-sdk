<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\OdklGroup;
use Dsl\MyTarget\Domain\V1\VkGroup;
use Dsl\MyTarget\Mapper\Mapper;

class GroupsOperator
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
     * @param string $query
     * @param int $limit
     * @param array|null $context
     *
     * @return OdklGroup[]
     */
    public function getOdklGroups($query, $limit = 10, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "groups-get-odkl"];

        $json = $this->client->get("/api/v1/odkl_groups.json", ["q" => $query, "limit" => $limit], $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(OdklGroup::class, $json);
        }, $json);
    }

    /**
     * @param string $query
     * @param array|null $context
     *
     * @return VkGroup[]
     */
    public function getVkGroups($query, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "groups-get-vk"];

        $json = $this->client->get("/api/v1/vk_groups.json", ["q" => $query], $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(VkGroup::class, $json);
        }, $json);
    }
}
