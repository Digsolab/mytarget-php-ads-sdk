<?php

namespace Dsl\MyTarget\Domain\V1;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Agency
{
    /**
     * @var bool
     * @Field(name="is_buyer", type="bool")
     */
    private $isBuyer;

    /**
     * @var string
     * @Field(name="overriding_commission", type="string")
     */
    private $overridingCommission;

    /**
     * @var string
     * @Field(name="buyer_commission", type="string")
     */
    private $buyerCommission;

    /**
     * @return bool
     */
    public function isIsBuyer()
    {
        return $this->isBuyer;
    }

    /**
     * @param bool $isBuyer
     */
    public function setIsBuyer($isBuyer)
    {
        $this->isBuyer = $isBuyer;
    }

    /**
     * @return string
     */
    public function getOverridingCommission()
    {
        return $this->overridingCommission;
    }

    /**
     * @param string $overridingCommission
     */
    public function setOverridingCommission($overridingCommission)
    {
        $this->overridingCommission = $overridingCommission;
    }

    /**
     * @return string
     */
    public function getBuyerCommission()
    {
        return $this->buyerCommission;
    }

    /**
     * @param string $buyerCommission
     */
    public function setBuyerCommission($buyerCommission)
    {
        $this->buyerCommission = $buyerCommission;
    }
}
