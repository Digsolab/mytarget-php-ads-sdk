<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\DateRange;
use Dsl\MyTarget\Domain\V1\Demography\DetailedExactDemographyCampaigns;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget as f;

class DetailedExactDemographyOperator
{
    const DATE_FORMAT = "d.m.Y";

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Mapper
     */
    private $mapper;

    /**
     * @param Client $client
     * @param Mapper $mapper
     */
    public function __construct(Client $client, Mapper $mapper)
    {
        $this->client = $client;
        $this->mapper = $mapper;
    }

    /**
     * @param array      $ids
     * @param DateRange  $dateRange
     * @param array|null $context
     *
     * @return DetailedExactDemographyCampaigns
     */
    public function findAll(array $ids, DateRange $dateRange, array $context = null)
    {
        $query = [
            'date_from' => $dateRange->getFrom()->format(self::DATE_FORMAT),
            'date_to' => $dateRange->getTo()->format(self::DATE_FORMAT),
        ];

        $path = sprintf('/api/v1/statistics/campaigns/%s/detailed_exact_demography.json', implode(';', $ids));

        $json = $this->client->get($path, $query, $context);
        $json = f\objects_array_fixup($json, count($ids));

        return $this->mapper->hydrateNew(DetailedExactDemographyCampaigns::class, $json);
    }
}
