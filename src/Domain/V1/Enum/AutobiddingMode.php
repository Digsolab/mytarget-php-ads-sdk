<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class AutobiddingMode extends AbstractEnum
{
    const FIXED = 'fixed';
    const SECOND_PRICE = 'second_price';
    const SECOND_PRICE_MEAN = 'second_price_mean';

    /**
     * @return AutobiddingMode
     */
    public static function fixed()
    {
        return AutobiddingMode::fromValue(self::FIXED);
    }

    /**
     * @return AutobiddingMode
     */
    public static function secondPrice()
    {
        return AutobiddingMode::fromValue(self::SECOND_PRICE);
    }

    /**
     * @return AutobiddingMode
     */
    public static function secondPriceMean()
    {
        return AutobiddingMode::fromValue(self::SECOND_PRICE_MEAN);
    }
}
