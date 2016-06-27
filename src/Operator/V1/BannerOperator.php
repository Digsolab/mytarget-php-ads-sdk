<?php

namespace MyTarget\Operator\V1;

use MyTarget\Client;
use MyTarget\Domain\V1\Banner;
use MyTarget\Domain\V1\BannerStat;
use MyTarget\Domain\V1\Enum\Status;
use MyTarget\Mapper\Mapper;
use MyTarget\Operator\V1\Fields\BannerFields;

class BannerOperator
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
     * @param int $campaignId
     * @param Banner $banner
     * @param array|null $context
     *
     * @return Banner|null
     */
    public function create($campaignId, Banner $banner, array $context = null)
    {
        $banners = $this->createAll($campaignId, [$banner], $context);

        return $banners ? reset($banners) : null;
    }

    /**
     * @param int $campaignId
     * @param Banner[] $banners
     * @param array|null $context
     *
     * @return Banner[]
     */
    public function createAll($campaignId, array $banners, array $context = null)
    {
        $rawBanners = array_map(function (Banner $banner) {
            return $this->mapper->snapshot($banner);
        }, array_values($banners));

        $path = sprintf("/api/v1/campaigns/%d/banners.json", $campaignId);
        $json = $this->client->post($path, null, $rawBanners, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(Banner::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param BannerFields|null $fields
     * @param array|null $context
     *
     * @return BannerStat|null
     */
    public function find($id, BannerFields $fields = null, array $context = null)
    {
        $banners = $this->findAll([$id], $fields, null, null, $context);

        return $banners ? reset($banners) : null;
    }

    /**
     * @param int[] $ids
     * @param BannerFields $fields
     * @param Status[]|null $withStatuses
     * @param Status[]|null $withCampaignStatuses
     * @param array|null $context
     *
     * @return BannerStat[]
     */
    public function findAll(array $ids, BannerFields $fields = null,
        array $withStatuses = null, array $withCampaignStatuses = null, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "banners-find"];
        $fields = $fields ?: BannerFields::create();

        $query = ["fields" => $this->mapFields($fields->getFields())];
        if ($withStatuses && null !== ($status = Status::inApiFormat($withStatuses))) {
            $query["status"] = $status;
        }
        if ($withCampaignStatuses && null !== ($campaignStatus = Status::inApiFormat($withCampaignStatuses))) {
            $query["campaign__status"] = $campaignStatus;
        }

        $path = sprintf("/api/v1/banners/%s.json", implode(";", $ids));
        $json = $this->client->get($path, $query, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(BannerStat::class, $json);
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
        return array_map(function ($field) {
            return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $field));
        }, $fields);
    }
}
