<?php

namespace MyTarget\Operator\V1\Remarketing;

use MyTarget\Client;
use MyTarget\Domain\V1\Remarketing\RemarketingVkApp;
use MyTarget\Domain\V1\Remarketing\RemarketingVkAppStat;
use MyTarget\Mapper\Mapper;

class RemarketingVkAppsOperator
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
     * @param RemarketingVkApp $app
     * @param array|null $context
     *
     * @return RemarketingVkAppStat
     */
    public function create(RemarketingVkApp $app, array $context = null)
    {
        $rawApp = $this->mapper->snapshot($app);

        $json = $this->client->post("/api/v1/remarketing_vk_apps.json", null, $rawApp, $context);

        return $this->mapper->hydrateNew(RemarketingVkAppStat::class, $json);
    }

    /**
     * @param array|null $context
     *
     * @return RemarketingVkAppStat[]
     */
    public function all(array $context = null)
    {
        $json = $this->client->get("/api/v1/remarketing_vk_apps.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingVkAppStat::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param array|null $context
     */
    public function delete($id, array $context = null)
    {
        $path = sprintf("/api/v1/remarketing_vk_apps/%d.json", $id);
        $this->client->delete($path, null, $context);
    }
}
