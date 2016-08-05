<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Domain\V1\Campaign\Campaign;
use Dsl\MyTarget\Mapper\Annotation\Field;

class RemarketingStat extends Remarketing
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var Campaign[]
     * @Field(type="array<Dsl\MyTarget\Domain\V1\Campaign\Campaign>")
     */
    private $campaigns;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Campaign[]
     */
    public function getCampaigns()
    {
        return $this->campaigns;
    }
}
