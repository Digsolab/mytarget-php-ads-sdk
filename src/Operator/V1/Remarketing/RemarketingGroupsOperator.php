<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingGroup;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingGroupsOperator
{
    const LIMIT_CREATE = "remarketing-groups-create";
    const LIMIT_FIND = "remarketing-groups-find";
    const LIMIT_DELETE = "remarketing-groups-delete";

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
     * @return RemarketingGroup[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get("/api/v1/remarketing_groups.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingGroup::class, $json);
        }, $json);
    }

    /**
     * @param RemarketingGroup $group
     * @param Context|null $context
     *
     * @return RemarketingGroup
     */
    public function create(RemarketingGroup $group, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
        $rawGroup = $this->mapper->snapshot($group);

        $json = $this->client->post("/api/v1/remarketing_groups.json", null, $rawGroup, $context);

        return $this->mapper->hydrateNew(RemarketingGroup::class, $json);
    }

    /**
     * @param int $id
     * @param Context|null $context
     */
    public function delete($id, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_DELETE);
        $this->client->delete(sprintf("/api/v1/remarketing_groups/%d.json", $id), null, $context);
    }
}
