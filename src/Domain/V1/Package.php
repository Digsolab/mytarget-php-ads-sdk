<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\Hydrated;
use MyTarget\Domain\V1\Enum\Status;
use MyTarget\DomainFactory;
use MyTarget\Util\DataAccess\DataAccess;

class Package extends Hydrated
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Status */
    private $status;

    /** @var Status */
    private $systemStatus;

    /** @var string */
    private $description;

    /** @var string */
    private $pricePerShow;

    /** @var string */
    private $pricePerClick;

    /** @var string */
    private $maxPricePerUnit;

    /** @var mixed */
    private $features;

    /** @var string */
    private $bannerFormat;

    /** @var Targeting */
    private $targetings;

    /** @var string[] */
    private $flags;

    /** @var int */
    private $maxUniqShowsLimit;

    /** @var int */
    private $relatedPackageId;

    /** @var mixed */
    private $options;

    /**
     * @inheritdoc
     */
    public function load(DataAccess $data, DomainFactory $factory)
    {
        $this->targetings = $data->peek("targetings")
            ->map($factory->factorize(Targeting::class))->unwrap();

        $this->id = $data->getOrNull("id");
        $this->name = $data->getOrNull("name");
        $this->status = $data->peek("status")->map([Status::class, "fromValue"])->unwrap();
        $this->systemStatus = $data->peek("system_status")->map([Status::class, "fromValue"])->unwrap();
        $this->description = $data->getOrNull("description");
        $this->pricePerShow = $data->getOrNull("price_per_show");
        $this->pricePerClick = $data->getOrNull("price_per_click");
        $this->maxPricePerUnit = $data->getOrNull("max_price_per_unit");
        $this->features = $data->getOrNull("features");
        $this->bannerFormat = $data->getOrNull("banner_format");
        $this->flags = $data->getOrNull("flags");
        $this->maxUniqShowsLimit = $data->getOrNull("max_uniq_shows_limit");
        $this->relatedPackageId = $data->getOrNull("related_package_id");
        $this->options = $data->getOrNull("options");
    }

    /**
     * @inheritdoc
     */
    public function unload()
    {
        return ["id" => $this->id];
    }
}
