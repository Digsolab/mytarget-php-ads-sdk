<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Remarketing\Remarketing;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingStat;
use Dsl\MyTarget\Mapper\Mapper;

class RemarketingOperator
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
     * @param array|null $context
     *
     * @return RemarketingStat[]
     */
    public function all(array $context = null)
    {
        $context = (array)$context + ["limit-by" => "remarketing-find"];
        $json = $this->client->get("/api/v1/remarketings.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingStat::class, $json);
        }, $json);
    }

    /**
     * @param Remarketing $remarketing
     * @param array|null $context
     *
     * @return RemarketingStat
     */
    public function create(Remarketing $remarketing, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "remarketing-create"];
        $rawRemarketing = $this->mapper->snapshot($remarketing);

        $json = $this->client->post("/api/v1/remarketings.json", null, $rawRemarketing, $context);

        return $this->mapper->hydrateNew(RemarketingStat::class, $json);
    }

    /**
     * @param int $id
     * @param Remarketing $remarketing
     * @param array|null $context
     *
     * @return RemarketingStat
     */
    public function edit($id, Remarketing $remarketing, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "remarketing-edit"];
        $rawRemarketing = $this->mapper->snapshot($remarketing, Remarketing::class);

        $path = sprintf("/api/v1/remarketings/%d.json", $id);
        $json = $this->client->post($path, null, $rawRemarketing, $context);

        return $this->mapper->hydrateNew(RemarketingStat::class, $json);
    }

    /**
     * @param int $id
     * @param array|null $context
     */
    public function delete($id, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "remarketing-delete"];
        $this->client->delete(sprintf("/api/v1/remarketings/%d.json", $id), null, $context);
    }
}
