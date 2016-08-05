<?php

namespace Dsl\MyTarget\Domain\V1\Targeting;

use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingCounterInterval;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingGameInterval;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingPricelistInterval;
use Dsl\MyTarget\Mapper\Annotation\Field;

class Targeting extends CampaignTargeting
{
    /**
     * @var RemarketingCounterInterval[]
     * @Field(name="remarketing_counters", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingCounterInterval>")
     */
    private $remarketingCounters;

    /**
     * @var RemarketingPricelistInterval[]
     * @Field(name="remarketing_price_lists", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingPricelistInterval>")
     */
    private $remarketingPriceLists;

    /**
     * @var RemarketingGameInterval
     * @Field(name="remarketing_game_players", type="Dsl\MyTarget\Domain\V1\Remarketing\RemarketingGameInterval")
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
