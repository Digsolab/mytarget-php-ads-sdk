<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Domain\V1\Enum\RemarketingType;
use Dsl\MyTarget\Mapper\Annotation\Field;

class RemarketingPricelistInterval extends RemarketingInterval
{
    /**
     * @var int
     * @Field(name="shop_id", type="int")
     */
    private $shopId;

    /**
     * @var int
     * @Field(name="feed_id", type="int")
     */
    private $feedId;

    /**
     * @var int
     * @Field(name="pricelist_id", type="int")
     */
    private $pricelistId;

    /**
     * @param int $pricelistId
     * @param int $left
     * @param int $right
     * @param RemarketingType $type
     * @param int|null $shopId
     * @param int|null $feedId
     */
    public function __construct($pricelistId, $left, $right, RemarketingType $type, $shopId = null, $feedId = null)
    {
        parent::__construct($left, $right, $type);

        $this->shopId =  $shopId;
        $this->feedId = $feedId;
        $this->pricelistId = $pricelistId;
    }

    /**
     * @return int
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @return int
     */
    public function getFeedId()
    {
        return $this->feedId;
    }

    /**
     * @return int
     */
    public function getPricelistId()
    {
        return $this->pricelistId;
    }
}
