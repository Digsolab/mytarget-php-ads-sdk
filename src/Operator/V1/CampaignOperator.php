<?php

namespace MyTarget\Operator\V1;

use MyTarget\Domain\V1\CampaignStat;
use MyTarget\Domain\V1\Enum\Status;
use MyTarget\DomainFactory;
use MyTarget\Operator\V1\Fields\CampaignFields;
use MyTarget\Client;

class CampaignOperator
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var DomainFactory
     */
    private $domainFactory;

    public function __construct(Client $client, DomainFactory $domainFactory)
    {
        $this->client = $client;
        $this->domainFactory = $domainFactory;
    }

    /**
     * @param string $username
     * @param CampaignFields|null $fields
     * @param Status[]|null $withStatuses
     * @param mixed|null $context
     *
     * @return CampaignStat[]
     */
    public function all($username, CampaignFields $fields = null, array $withStatuses = null, $context = null)
    {
        $fields = $fields ?: CampaignFields::create();

        $query = ["fields" => implode(",", $this->mapFields($fields->getFields()))];

        if ($withStatuses && null !== ($status = Status::inApiFormat($withStatuses))) {
            $query["status"] = $status;
        }

        if (in_array(CampaignFields::FIELD_BANNERS, $fields->getFields(), true)) {
            $query["with_banners"] = "1";
        }

        $json = $this->client->get("/api/v1/campaigns.json", $query, $username, $context);
        $factory = $this->domainFactory->factorize(CampaignStat::class);

        return array_map($factory, $json);
    }

    /**
     * @param int $id
     * @param mixed|null $context
     *
     * @return CampaignStat
     */
    public function find($id, $context = null)
    {
        $json = $this->client->get(sprintf('/api/v1/campaigns/%d.json', $id), null, $context);
        $factory = $this->domainFactory->factorize(CampaignStat::class);

        return $factory($json);
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
