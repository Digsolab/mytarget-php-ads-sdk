<?php

namespace MyTarget\Operator\V1;

use MyTarget\Client;
use MyTarget\Domain\V1\Campaign\Package;
use MyTarget\Mapper\Mapper;

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
