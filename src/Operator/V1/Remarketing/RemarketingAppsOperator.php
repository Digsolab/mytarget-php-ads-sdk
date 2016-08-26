<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingApp;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingAppsOperator
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
     * @param RemarketingApp $app
     * @param array|null $context
     *
     * @return RemarketingApp
     */
    public function create(RemarketingApp $app, array $context = null)
    {
        $rawApp = $this->mapper->snapshot($app);

        $json = $this->client->post("/api/v1/remarketing_apps.json", null, $rawApp, $context);

        return $this->mapper->hydrateNew(RemarketingApp::class, $json);
    }

    /**
     * @param array|null $context
     *
     * @return RemarketingApp[]
     */
    public function all(array $context = null)
    {
        $json = $this->client->get("/api/v1/remarketing_apps.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingApp::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param array|null $context
     */
    public function delete($id, array $context = null)
    {
        $path = sprintf("/api/v1/remarketing_apps/%d.json", $id);
        $this->client->delete($path, null, $context);
    }
}
