<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkApp;
use Dsl\MyTarget\Mapper\Mapper;

class ClientRemarketingVkAppsOperator extends RemarketingVkAppsOperator
{
    /**
     * @var string
     */
    private $username;

    public function __construct($username, Client $client, Mapper $mapper)
    {
        parent::__construct($client, $mapper);

        $this->username = $username;
    }

    public function create(RemarketingVkApp $app, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::create($app, $context);
    }

    public function all(array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::all($context);
    }

    public function delete($id, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        parent::delete($id, $context);
    }
}
