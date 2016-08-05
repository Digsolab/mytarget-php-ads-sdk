<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Domain\V1\Campaign\Campaign;
use Dsl\MyTarget\Domain\V1\Campaign\CampaignStat;
use Dsl\MyTarget\Domain\V1\Campaign\MutateCampaign;
use Dsl\MyTarget\Domain\V1\Enum\Status;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Operator\V1\Fields\CampaignFields;
use Dsl\MyTarget\Client;

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
     * @param MutateCampaign $campaign
     * @param array|null $context
     *
     * @return Campaign
     */
    public function create(MutateCampaign $campaign, array $context = null)
    {
        $rawCampaign = $this->mapper->snapshot($campaign);

        $json = $this->client->post("/api/v1/campaigns.json", null, $rawCampaign, $context);

        return $this->mapper->hydrateNew(Campaign::class, $json);
    }

    /**
     * @param int $id
     * @param MutateCampaign $campaign
     * @param array|null $context
     *
     * @return Campaign
     */
    public function update($id, MutateCampaign $campaign, array $context = null)
    {
        $rawCampaign = $this->mapper->snapshot($campaign);

        $json = $this->client->post(sprintf("/api/v1/campaigns/%d.json", $id), null, $rawCampaign, $context);

        return $this->mapper->hydrateNew(Campaign::class, $json);
    }

    /**
     * Returns all campaigns with given statuses
     *
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

        if ($fields->hasField(CampaignFields::FIELD_BANNERS)) {
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
     * Returns campaign with given $id or null if it doesn't exist
     *
     * @param int $id
     * @param CampaignFields|null $fields
     * @param array|null $context
     *
     * @return CampaignStat|null
     */
    public function find($id, CampaignFields $fields = null, array $context = null)
    {
        $campaigns = $this->findAll([$id], $fields, null, $context);

        return $campaigns ? reset($campaigns) : null;
    }

    /**
     * Returns all campaigns with given $ids and statuses
     *
     * @param int[] $ids
     * @param CampaignFields|null $fields
     * @param Status[]|null $withStatuses
     * @param array|null $context
     *
     * @return CampaignStat[]
     */
    public function findAll(array $ids, CampaignFields $fields = null, array $withStatuses = null, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "campaigns-find"];

        $query = ["fields" => $this->mapFields($fields->getFields())];
        if ($fields->hasField(CampaignFields::FIELD_BANNERS)) {
            $query["with_banners"] = "1";
        }
        if ($withStatuses && ($status = Status::inApiFormat($withStatuses))) {
            $query["status"] = $status;
        }

        $path = sprintf("/api/v1/campaigns/%s.json", implode(";", $ids));
        $json = $this->client->get($path, $query, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(CampaignStat::class, $json);
        }, $json);
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
