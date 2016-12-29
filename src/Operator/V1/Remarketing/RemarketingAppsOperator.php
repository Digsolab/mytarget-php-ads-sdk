<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingApp;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingAppsOperator
{
    const LIMIT_CREATE = "remarketing-apps-create";
    const LIMIT_FIND = "remarketing-apps-find";
    const LIMIT_DELETE = "remarketing-apps-delete";

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
     * @param Context|null $context
     *
     * @return RemarketingApp
     */
    public function create(RemarketingApp $app, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
        $rawApp = $this->mapper->snapshot($app);

        $json = $this->client->post("/api/v1/remarketing_apps.json", null, $rawApp, $context);

        return $this->mapper->hydrateNew(RemarketingApp::class, $json);
    }

    /**
     * @param Context|null $context
     *
     * @return RemarketingApp[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get("/api/v1/remarketing_apps.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingApp::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param Context|null $context
     */
    public function delete($id, Context $context = null)
    {
        $path = sprintf("/api/v1/remarketing_apps/%d.json", $id);
        $this->client->delete($path, null, Context::withLimitBy($context, self::LIMIT_DELETE));
    }
}
