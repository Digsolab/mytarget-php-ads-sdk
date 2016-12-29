<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkApp;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkAppStat;
use Dsl\MyTarget\Mapper\Mapper;

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
        $context = (array)$context + ["limit-by" => "remarketing-vk-apps-create"];
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
        $context = (array)$context + ["limit-by" => "remarketing-vk-apps-find"];
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
        $context = (array)$context + ["limit-by" => "remarketing-vk-apps-delete"];
        $path = sprintf("/api/v1/remarketing_vk_apps/%d.json", $id);
        $this->client->delete($path, null, $context);
    }
}
