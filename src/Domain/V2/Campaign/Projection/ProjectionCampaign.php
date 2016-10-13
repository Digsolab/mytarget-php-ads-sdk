<?php

namespace Dsl\MyTarget\Domain\V2\Campaign\Projection;

use Dsl\MyTarget\Domain\V1\Campaign\Campaign;
use Dsl\MyTarget\Domain\V1\Campaign\Package;
use Dsl\MyTarget\Domain\V1\Targeting\CampaignTargeting;
use Dsl\MyTarget\Mapper\Annotation\Field;

class ProjectionCampaign extends Campaign
{

    /**
     * @var int
     * @Field(type="int")
     */
    private $step;

    /**
     * @var float
     * @Field(type="float", name="share_limit")
     */
    private $shareLimit;

    public function __construct(Package $package, CampaignTargeting $targeting, $step, $shareLimit)
    {
        parent::__construct(null, $package, $targeting);
        $this->step = $step;
        $this->shareLimit = $shareLimit;
    }

    /**
     * @return int
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @return float
     */
    public function getShareLimit()
    {
        return $this->shareLimit;
    }


}
