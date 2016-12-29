<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingGroup;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingGroupsOperator
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
     *
     * @return RemarketingGroup[]
     */
    public function all(array $context = null)
    {
        $context = (array)$context + ["limit-by" => "remarketing-groups-find"];
        $json = $this->client->get("/api/v1/remarketing_groups.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingGroup::class, $json);
        }, $json);
    }

    /**
     * @param RemarketingGroup $group
     * @param array|null $context
     *
     * @return RemarketingGroup
     */
    public function create(RemarketingGroup $group, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "remarketing-groups-create"];
        $rawGroup = $this->mapper->snapshot($group);

        $json = $this->client->post("/api/v1/remarketing_groups.json", null, $rawGroup, $context);

        return $this->mapper->hydrateNew(RemarketingGroup::class, $json);
    }

    /**
     * @param int $id
     * @param array|null $context
     */
    public function delete($id, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "remarketing-groups-delete"];
        $this->client->delete(sprintf("/api/v1/remarketing_groups/%d.json", $id), null, $context);
    }
}
