<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkApp;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkAppStat;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingVkAppsOperator
{
    const LIMIT_CREATE = "remarketing-vk-apps-create";
    const LIMIT_FIND = "remarketing-vk-apps-find";
    const LIMIT_DELETE = "remarketing-vk-apps-delete";

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
     * @param RemarketingVkApp $app
     * @param Context|null $context
     *
     * @return RemarketingVkAppStat
     */
    public function create(RemarketingVkApp $app, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
        $rawApp = $this->mapper->snapshot($app);

        $json = $this->client->post("/api/v1/remarketing_vk_apps.json", null, $rawApp, $context);

        return $this->mapper->hydrateNew(RemarketingVkAppStat::class, $json);
    }

    /**
     * @param Context|null $context
     *
     * @return RemarketingVkAppStat[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get("/api/v1/remarketing_vk_apps.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingVkAppStat::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param Context|null $context
     */
    public function delete($id, Context $context = null)
    {
        $path = sprintf("/api/v1/remarketing_vk_apps/%d.json", $id);
        $this->client->delete($path, null, Context::withLimitBy($context, self::LIMIT_DELETE));
    }
}
