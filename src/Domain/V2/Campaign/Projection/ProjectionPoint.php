<?php

namespace Dsl\MyTarget\Domain\V2\Campaign\Projection;

use Dsl\MyTarget\Mapper\Annotation\Field;

class ProjectionPoint
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $uniqs;

    /**
     * @var int
     * @Field(type="int")
     */
    private $share;

    /**
     * @var string
     * @Field(type="string", name="price_per_show")
     */
    private $pricePerShow;

    /**
     * @var string
     * @Field(type="string", name="price_per_click")
     */
    private $pricePerClick;

    /**
     * @return int
     */
    public function getUniqs()
    {
        return $this->uniqs;
    }

    /**
     * @return int
     */
    public function getShare()
    {
        return $this->share;
    }

    /**
     * @return string
     */
    public function getPricePerShow()
    {
        return $this->pricePerShow;
    }

    /**
     * @return string
     */
    public function getPricePerClick()
    {
        return $this->pricePerClick;
    }

}
