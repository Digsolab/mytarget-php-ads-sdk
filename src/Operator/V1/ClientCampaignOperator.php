<?php

namespace MyTarget\Operator\V1;

use MyTarget\Client;
use MyTarget\DomainFactory;
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
     * @param DomainFactory $domainFactory
     */
    public function __construct($username, Client $client, DomainFactory $domainFactory)
    {
        parent::__construct($client, $domainFactory);

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
    public function find($id, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::find($id, $context);
    }
}
