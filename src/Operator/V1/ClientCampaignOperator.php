<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;

use Dsl\MyTarget\Domain\V1\Campaign\MutateCampaign;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Operator\V1\Fields\CampaignFields;

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

    public function create(MutateCampaign $campaign, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::create($campaign, $context);
    }

    public function update($id, MutateCampaign $campaign, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::update($id, $campaign, $context);
    }

    public function findAll(array $ids, CampaignFields $fields = null, array $withStatuses = null, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::findAll($ids, $fields, $withStatuses, $context);
    }
}
