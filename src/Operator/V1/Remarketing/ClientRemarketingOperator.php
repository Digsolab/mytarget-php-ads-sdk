<?php

namespace MyTarget\Operator\V1\Remarketing;

use MyTarget\Client;
use MyTarget\Domain\V1\Remarketing\Remarketing;
use MyTarget\Mapper\Mapper;

class ClientRemarketingOperator extends RemarketingOperator
{
    /**
     * @var string
     */
    private $username;

    /**
     * @param string $username
     * @param Client $client
     * @param Mapper $mapper
     */
    public function __construct($username, Client $client, Mapper $mapper)
    {
        parent::__construct($client, $mapper);

        $this->username = $username;
    }

    public function all(array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::all($context);
    }

    public function create(Remarketing $remarketing, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::create($remarketing, $context);
    }

    public function edit($id, Remarketing $remarketing, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::edit($id, $remarketing, $context);
    }

    public function delete($id, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        parent::delete($id, $context);
    }
}
