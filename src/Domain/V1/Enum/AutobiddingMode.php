<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class AutobiddingMode extends AbstractEnum
{
    const FIXED = 'fixed';
    const SECOND_PRICE = 'second_price';
    const SECOND_PRICE_MEAN = 'second_price_mean';
}
