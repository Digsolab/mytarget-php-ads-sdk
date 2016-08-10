<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Campaign\Package;
use Dsl\MyTarget\Mapper\Mapper;

class PackagesOperator
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
     * @return Package[]
     */
    public function all(array $context = null)
    {
        $json = $this->client->get('/api/v1/packages.json', null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(Package::class, $json);
        }, $json);
    }

}
