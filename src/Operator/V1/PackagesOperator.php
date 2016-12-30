<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Campaign\Package;
use Dsl\MyTarget\Mapper\Mapper;

class PackagesOperator
{
    const LIMIT_FIND = "packages-find";

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
     * @return Package[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get('/api/v1/packages.json', null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(Package::class, $json);
        }, $json);
    }

}
