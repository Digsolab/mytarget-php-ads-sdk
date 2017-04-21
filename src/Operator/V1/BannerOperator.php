<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Banner\Banner;
use Dsl\MyTarget\Domain\V1\Banner\BannerStat;
use Dsl\MyTarget\Domain\V1\Enum\Status;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Operator\V1\Fields\BannerFields;
use Dsl\MyTarget as f;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Operator\V1\Fields\BannerRequest;

class BannerOperator
{
    const LIMIT_CREATE = "banner-create";
    const LIMIT_EDIT = "banner-edit";
    const LIMIT_FIND = "banners-find";

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
     * @param Context|null $context
     *
     * @return Banner|null
     */
    public function create($campaignId, Banner $banner, Context $context = null)
    {
        $banners = $this->createAll($campaignId, [$banner], $context);

        return $banners ? reset($banners) : null;
    }

    /**
     * @param int $campaignId
     * @param Banner[] $banners
     * @param Context|null $context
     *
     * @return Banner[] Created Banner objects with all fields filled
     */
    public function createAll($campaignId, array $banners, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
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
     * @param Banner $banner
     * @param BannerFields|null $fields
     * @param Context|null $context
     *
     * @return Banner|null
     */
    public function edit(Banner $banner, BannerFields $fields = null, Context $context = null)
    {
        $banners = $this->editAll([$banner], $fields, $context);

        return $banners ? reset($banners) : null;
    }

    /**
     * @param Banner[] $banners
     * @param BannerFields|null $fields Which fields to return in response
     * @param Context|null $context
     *
     * @return Banner[]
     */
    public function editAll(array $banners, BannerFields $fields = null, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_EDIT);
        $fields = $fields ?: BannerFields::create();

        $banners = array_values($banners);
        $ids = array_map(function (Banner $b) { return $b->getId(); }, $banners);
        $rawBanners = array_map([$this->mapper, "snapshot"], $banners);

        $query = ["fields" => $this->mapFields($fields->getFields())];
        $path = sprintf("/api/v1/banners/%s.json", implode(";", $ids));
        $json = $this->client->post($path, $query, $rawBanners, $context);
        $json = f\objects_array_fixup($json, count($banners));

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(Banner::class, $json);
        }, $json);
    }

    /**
     * @param BannerFields|null $fields
     * @param array|null        $withStatuses
     * @param array|null        $withCampaignStatuses
     * @param Context|null      $context
     *
     * @return BannerStat[]
     */
    public function all(BannerFields $fields = null,
        array $withStatuses = null, array $withCampaignStatuses = null, Context $context = null)
    {
        $request = new BannerRequest(null, $withStatuses, $withCampaignStatuses);

        return $this->findAll($request, $fields, $context);
    }

    /**
     * @param int $id
     * @param BannerFields|null $fields
     * @param Context|null $context
     *
     * @return BannerStat|null
     */
    public function find($id, BannerFields $fields = null, Context $context = null)
    {
        $request = new BannerRequest([$id]);
        $banners = $this->findAll($request, $fields, $context);

        return $banners ? reset($banners) : null;
    }

    /**
     * @param BannerRequest $request
     * @param BannerFields $fields
     * @param Context|null $context
     *
     * @return BannerStat[]
     */
    public function findAll(BannerRequest $request = null, BannerFields $fields = null, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $fields = $fields ?: BannerFields::create();
        $request = $request ?: new BannerRequest();

        $query = ["fields" => $this->mapFields($fields->getFields())];
        if ($request->getWithStatuses() && null !== ($status = Status::inApiFormat($request->getWithStatuses()))) {
            $query["status"] = $status;
        }
        if ($request->getWithCampaignStatuses() && null !== ($campaignStatus = Status::inApiFormat($request->getWithCampaignStatuses()))) {
            $query["campaign__status"] = $campaignStatus;
        }
        if ($request->getStatsChangedAfter()) {
            $query["last_stats_updated__gte"] = $request->getStatsChangedAfter()->format("Y-m-d H:i:s");
        }
        if ($request->getUpdatedAfter()) {
            $query["updated__gte"] = $request->getUpdatedAfter()->format("Y-m-d H:i:s");
        }

        if ($request->getIds()) {
            $path = sprintf("/api/v1/banners/%s.json", implode(";", $request->getIds()));
        } elseif ($request->getCampaignId()) {
            $path = sprintf("/api/v1/campaigns/%d/banners.json", $request->getCampaignId());
        } else {
            $path = "/api/v1/banners.json";
        }
        $json = $this->client->get($path, $query, $context);
        $json = f\objects_array_fixup($json, count($request->getIds()));

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(BannerStat::class, $json);
        }, $json);
    }

    /**
     * @param integer           $campaignId
     * @param BannerFields|null $fields
     * @param array|null        $withStatuses
     * @param array|null        $withCampaignStatuses
     * @param array|null        $context
     *
     * @return BannerStat[]
     */
    public function findForCampaign($campaignId, BannerFields $fields = null, array $withStatuses = null, array $withCampaignStatuses = null, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "banners-find"];
        $fields = $fields ?: BannerFields::create();
        $request = new BannerRequest(null, $withStatuses, $withCampaignStatuses);

        $query = ["fields" => $this->mapFields($fields->getFields())];

        if ($request->getWithStatuses() && null !== ($status = Status::inApiFormat($request->getWithStatuses()))) {
            $query["status"] = $status;
        }
        if ($request->getWithCampaignStatuses() && null !== ($campaignStatus = Status::inApiFormat($request->getWithCampaignStatuses()))) {
            $query["campaign__status"] = $campaignStatus;
        }
        if ($request->getStatsChangedAfter()) {
            $query["last_stats_updated__gte"] = $request->getStatsChangedAfter()->format("Y-m-d H:i:s");
        }
        if ($request->getUpdatedAfter()) {
            $query["updated__gte"] = $request->getUpdatedAfter()->format("Y-m-d H:i:s");
        }

        $path = sprintf("/api/v1/campaigns/%d/banners.json", $campaignId);
        $json = $this->client->get($path, $query, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(BannerStat::class, $json);
        }, $json);
    }

    /**
     * TODO to be changed
     *
     * @param array $fields
     * @return string
     */
    private function mapFields(array $fields)
    {
        $fields = array_map(function ($field) {
            return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $field));
        }, $fields);

        return implode(",", $fields);
    }
}
