<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class Targeting extends CampaignTargeting
{
    /**
     * @var RemarketingCounterInterval[]
     * @Field(name="remarketing_counters", type="array<RemarketingCounterInterval>")
     */
    private $remarketingCounters;

    /**
     * @var RemarketingPriceListInterval[]
     * @Field(name="remarketing_price_lists", type="array<RemarketingPriceListInterval>")
     */
    private $remarketingPriceLists;

    /**
     * @var RemarketingGameInterval
     * @Field(name="remarketing_game_players", type="RemarketingGameInterval")
     */
    private $remarketingGamePlayers;
}
