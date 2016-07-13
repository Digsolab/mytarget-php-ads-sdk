<?php

namespace MyTarget\Operator\V1\Remarketing;

use MyTarget\Client;
use MyTarget\Domain\V1\Remarketing\RemarketingVkGroup;
use MyTarget\Domain\V1\Remarketing\RemarketingVkGroupStat;
use MyTarget\Mapper\Mapper;

class RemarketingVkGroupsOperator
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
     * @param string $username
     *
     * @return ClientRemarketingVkGroupsOperator
     */
    public function forClient($username)
    {
        return new ClientRemarketingVkGroupsOperator($username, $this->client, $this->mapper);
    }

    /**
     * @param array|null $context
     *
     * @return RemarketingVkGroupStat[]
     */
    public function all(array $context = null)
    {
        $json = $this->client->get("/api/v1/remarketing_vk_groups.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingVkGroupStat::class, $json);
        }, $json);
    }

    /**
     * @param RemarketingVkGroup $group
     * @param array|null $context
     *
     * @return RemarketingVkGroupStat
     */
    public function create(RemarketingVkGroup $group, array $context = null)
    {
        $rawGroup = $this->mapper->snapshot($group);

        $json = $this->client->post("/api/v1/remarketing_vk_groups.json", null, $rawGroup, $context);

        return $this->mapper->hydrateNew(RemarketingVkGroupStat::class, $json);
    }

    /**
     * @param int $id RemarketingVkGroupStat->id value (not vk's group_id)
     *
     * @param array|null $context
     */
    public function delete($id, array $context = null)
    {
        $path = sprintf("/api/v1/remarketing_vk_groups/%d.json", $id);
        $this->client->delete($path, null, $context);
    }
}
