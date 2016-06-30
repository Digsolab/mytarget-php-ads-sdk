<?php

namespace MyTarget\Operator\V1;

use MyTarget\Domain\V1\CampaignStat;
use MyTarget\Domain\V1\Enum\Status;
use MyTarget\Mapper\Mapper;
use MyTarget\Operator\V1\Fields\CampaignFields;
use MyTarget\Client;

class CampaignOperator
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
     * @param string $username
     * @return ClientCampaignOperator
     */
    public function forClient($username)
    {
        return new ClientCampaignOperator($username, $this->client, $this->mapper);
    }

    /**
     * @param CampaignFields|null $fields
     * @param Status[]|null $withStatuses
     * @param array|null $context
     *
     * @return CampaignStat[]
     */
    public function all(CampaignFields $fields = null, array $withStatuses = null, array $context = null)
    {
        $fields = $fields ?: CampaignFields::create();

        $query = ["fields" => implode(",", $this->mapFields($fields->getFields()))];

        if ($withStatuses && null !== ($status = Status::inApiFormat($withStatuses))) {
            $query["status"] = $status;
        }

        if (in_array(CampaignFields::FIELD_BANNERS, $fields->getFields(), true)) {
            $query["with_banners"] = "1";
        }

        $context = (array)$context + ["limit-by" => "campaigns-all"];

        $json = $this->client->get("/api/v1/campaigns.json", $query, $context);

        $objects = array_map(function ($json) {
            return $this->mapper->hydrateNew(CampaignStat::class, $json);
        }, $json);

        return $objects;
    }

    /**
     * @param int $id
     * @param array|null $context
     *
     * @return CampaignStat
     */
    public function find($id, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "campaigns-find"];

        $json = $this->client->get(sprintf('/api/v1/campaigns/%d.json', $id), null, $context);

        return $this->mapper->hydrateNew(CampaignStat::class, $json);
    }

    /**
     * TODO to be changed
     *
     * @param array $fields
     * @return array
     */
    private function mapFields(array $fields)
    {
        $fields = array_filter($fields, function ($field) {
            return $field !== CampaignFields::FIELD_BANNERS;
        });

        return array_map(function ($field) {
            return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $field));
        }, $fields);
    }
}
