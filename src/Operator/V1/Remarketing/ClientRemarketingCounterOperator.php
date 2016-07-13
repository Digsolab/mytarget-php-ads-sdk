<?php

namespace MyTarget\Operator\V1\Remarketing;

use MyTarget\Client;
use MyTarget\Domain\V1\Remarketing\RemarketingCounter;
use MyTarget\Mapper\Mapper;

class ClientRemarketingCounterOperator extends RemarketingCounterOperator
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

    public function create(RemarketingCounter $counter, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::create($counter, $context);
    }

    public function edit($id, RemarketingCounter $counter, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::edit($id, $counter, $context);
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
