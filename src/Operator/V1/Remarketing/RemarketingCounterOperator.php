<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingCounter;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingCounterOperator
{
    const LIMIT_CREATE = "remarketing-counter-create";
    const LIMIT_EDIT = "remarketing-counter-edit";
    const LIMIT_FIND = "remarketing-counter-find";
    const LIMIT_DELETE = "remarketing-counter-delete";

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
     * @param RemarketingCounter $counter
     * @param Context|null $context
     *
     * @return RemarketingCounter
     */
    public function create(RemarketingCounter $counter, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
        $rawCounter = $this->mapper->snapshot($counter);

        $json = $this->client->post("/api/v1/remarketing_counters.json", null, $rawCounter, $context);

        return $this->mapper->hydrateNew(RemarketingCounter::class, $json);
    }

    /**
     * @param int $id
     * @param RemarketingCounter $counter
     * @param Context|null $context
     *
     * @return RemarketingCounter
     */
    public function edit($id, RemarketingCounter $counter, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_EDIT);
        $rawCounter = $this->mapper->snapshot($counter);

        $json = $this->client->post(sprintf("/api/v1/remarketing_counters/%d.json", $id), null, $rawCounter, $context);

        return $this->mapper->hydrateNew(RemarketingCounter::class, $json);
    }

    /**
     * @param Context|null $context
     *
     * @return RemarketingCounter[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get("/api/v1/remarketing_counters.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingCounter::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param Context|null $context
     */
    public function delete($id, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_DELETE);
        $path = sprintf("/api/v1/remarketing_counters/%d.json", $id);
        $this->client->delete($path, null, $context);
    }
}
