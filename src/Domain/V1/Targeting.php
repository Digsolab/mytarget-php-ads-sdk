<?php

namespace MyTarget\Domain\V1;

class Targeting extends CampaignTargeting
{
    /** @var RemarketingCounterInterval[] */
    private $remarketingCounters;

    /** @var RemarketingPriceListInterval[] */
    private $remarketingPriceLists;

    /** @var RemarketingGameInterval */
    private $remarketingGamePlayers;
}
