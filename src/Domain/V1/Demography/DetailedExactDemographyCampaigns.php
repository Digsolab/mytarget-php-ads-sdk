<?php

namespace Dsl\MyTarget\Domain\V1\Demography;

use Dsl\MyTarget\Mapper\Annotation\Field;

class DetailedExactDemographyCampaigns
{

    /**
     * @var DetailedExactDemography[]
     * @Field(type="array<Dsl\MyTarget\Domain\V1\DetailedExactDemography>")
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
