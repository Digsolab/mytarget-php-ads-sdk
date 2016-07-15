<?php

namespace MyTarget\Domain\V1\Remarketing;

use MyTarget\Domain\V1\Campaign;
use MyTarget\Mapper\Annotation\Field;

class RemarketingStat extends Remarketing
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var Campaign[]
     * @Field(type="array<MyTarget\Domain\V1\Campaign>")
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
