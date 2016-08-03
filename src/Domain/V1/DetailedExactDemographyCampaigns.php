<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class DetailedExactDemographyCampaigns
{

    /**
     * @var DetailedExactDemography[]
     * @Field(type="array<MyTarget\Domain\V1\DetailedExactDemography>")
     */
    private $campaigns;

    /**
     * @return DetailedExactDemography[]
     */
    public function getCampaigns()
    {
        return $this->campaigns;
    }

}
