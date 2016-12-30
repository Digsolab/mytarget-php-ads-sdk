<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Remarketing\Remarketing;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingStat;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingOperator
{
    const LIMIT_FIND = "remarketing-find";
    const LIMIT_CREATE = "remarketing-create";
    const LIMIT_EDIT = "remarketing-edit";
    const LIMIT_DELETE = "remarketing-delete";

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
     * @return RemarketingStat[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get("/api/v1/remarketings.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingStat::class, $json);
        }, $json);
    }

    /**
     * @param Remarketing $remarketing
     * @param Context|null $context
     *
     * @return RemarketingStat
     */
    public function create(Remarketing $remarketing, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
        $rawRemarketing = $this->mapper->snapshot($remarketing);

        $json = $this->client->post("/api/v1/remarketings.json", null, $rawRemarketing, $context);

        return $this->mapper->hydrateNew(RemarketingStat::class, $json);
    }

    /**
     * @param int $id
     * @param Remarketing $remarketing
     * @param Context|null $context
     *
     * @return RemarketingStat
     */
    public function edit($id, Remarketing $remarketing, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_EDIT);
        $rawRemarketing = $this->mapper->snapshot($remarketing, Remarketing::class);

        $path = sprintf("/api/v1/remarketings/%d.json", $id);
        $json = $this->client->post($path, null, $rawRemarketing, $context);

        return $this->mapper->hydrateNew(RemarketingStat::class, $json);
    }

    /**
     * @param int $id
     * @param Context|null $context
     */
    public function delete($id, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_DELETE);
        $this->client->delete(sprintf("/api/v1/remarketings/%d.json", $id), null, $context);
    }
}
