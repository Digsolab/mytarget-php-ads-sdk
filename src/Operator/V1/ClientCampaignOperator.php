<?php

namespace MyTarget\Operator\V1;

use MyTarget\Client;
use MyTarget\Domain\V1\Campaign;
use MyTarget\Mapper\Mapper;
use MyTarget\Operator\V1\Fields\CampaignFields;

class ClientCampaignOperator extends CampaignOperator
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

    /**
     * @inheritdoc
     */
    public function all(CampaignFields $fields = null, array $withStatuses = null, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::all($fields, $withStatuses, $context);
    }

    /**
     * @inheritdoc
     */
    public function find($id, CampaignFields $fields = null, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::find($id, $context);
    }

    public function create(Campaign $campaign, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::create($campaign, $context);
    }

    public function update(Campaign $campaign, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::update($campaign, $context);
    }

    public function findAll(array $ids, CampaignFields $fields = null, array $withStatuses = null, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::findAll($ids, $fields, $withStatuses, $context);
    }
}
