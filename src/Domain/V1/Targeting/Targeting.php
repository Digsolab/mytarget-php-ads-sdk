<?php

namespace MyTarget\Domain\V1\Targeting;

use MyTarget\Domain\V1\Remarketing\RemarketingCounterInterval;
use MyTarget\Domain\V1\Remarketing\RemarketingGameInterval;
use MyTarget\Domain\V1\Remarketing\RemarketingPricelistInterval;
use MyTarget\Mapper\Annotation\Field;

class Targeting extends CampaignTargeting
{
    /**
     * @var RemarketingCounterInterval[]
     * @Field(name="remarketing_counters", type="array<MyTarget\Domain\V1\Remarketing\RemarketingCounterInterval>")
     */
    private $remarketingCounters;

    /**
     * @var RemarketingPricelistInterval[]
     * @Field(name="remarketing_price_lists", type="array<MyTarget\Domain\V1\Remarketing\RemarketingPricelistInterval>")
     */
    private $remarketingPriceLists;

    /**
     * @var RemarketingGameInterval
     * @Field(name="remarketing_game_players", type="MyTarget\Domain\V1\Remarketing\RemarketingGameInterval")
     */
    private $remarketingGamePlayers;

    /**
     * @return RemarketingCounterInterval[]
     */
    public function getRemarketingCounters()
    {
        return $this->remarketingCounters;
    }

    /**
     * @param RemarketingCounterInterval[] $remarketingCounters
     */
    public function setRemarketingCounters(array $remarketingCounters)
    {
        $this->remarketingCounters = $remarketingCounters;
    }

    /**
     * @return RemarketingPricelistInterval[]
     */
    public function getRemarketingPriceLists()
    {
        return $this->remarketingPriceLists;
    }

    /**
     * @param RemarketingPricelistInterval[] $remarketingPriceLists
     */
    public function setRemarketingPriceLists(array $remarketingPriceLists)
    {
        $this->remarketingPriceLists = $remarketingPriceLists;
    }

    /**
     * @return RemarketingGameInterval
     */
    public function getRemarketingGamePlayers()
    {
        return $this->remarketingGamePlayers;
    }

    /**
     * @param RemarketingGameInterval $remarketingGamePlayers
     */
    public function setRemarketingGamePlayers(RemarketingGameInterval $remarketingGamePlayers)
    {
        $this->remarketingGamePlayers = $remarketingGamePlayers;
    }
}
