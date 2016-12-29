<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkGroup;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkGroupStat;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingVkGroupsOperator
{
    const LIMIT_FIND = "remarketing-vk-groups-find";
    const LIMIT_CREATE = "remarketing-vk-groups-create";
    const LIMIT_DELETE = "remarketing-vk-groups-delete";

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
     *
     * @return RemarketingVkGroupStat[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get("/api/v1/remarketing_vk_groups.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingVkGroupStat::class, $json);
        }, $json);
    }

    /**
     * @param RemarketingVkGroup $group
     * @param Context|null $context
     *
     * @return RemarketingVkGroupStat
     */
    public function create(RemarketingVkGroup $group, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
        $rawGroup = $this->mapper->snapshot($group);

        $json = $this->client->post("/api/v1/remarketing_vk_groups.json", null, $rawGroup, $context);

        return $this->mapper->hydrateNew(RemarketingVkGroupStat::class, $json);
    }

    /**
     * @param int $id RemarketingVkGroupStat->id value (not vk's group_id)
     *
     * @param Context|null $context
     */
    public function delete($id, Context $context = null)
    {
        $path = sprintf("/api/v1/remarketing_vk_groups/%d.json", $id);
        $this->client->delete($path, null, Context::withLimitBy($context, self::LIMIT_DELETE));
    }
}
