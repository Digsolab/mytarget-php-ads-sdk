<?php

namespace Dsl\MyTarget\Domain\V2\Campaign\Projection;

use Dsl\MyTarget\Domain\V1\Campaign\Campaign;
use Dsl\MyTarget\Domain\V1\Campaign\Package;
use Dsl\MyTarget\Domain\V2\Campaign\Projection\Targeting\ProjectionTargetingSettings;
use Dsl\MyTarget\Exception\InvalidArgumentException;
use Dsl\MyTarget\Mapper\Annotation\Field;

class ProjectionSettings
{
    /**
     * @var Package
     * @Field(type="Dsl\MyTarget\Domain\V1\Campaign\Package")
     */
    private $package;

    /**
     * @var Package
     * @Field(type="Dsl\MyTarget\Domain\V1\Campaign\Campaign")
     */
    private $campaign;

    /**
     * @var ProjectionTargetingSettings
     * @Field(type="Dsl\MyTarget\Domain\V2\Campaign\Projection\Targeting\ProjectionTargetingSettings")
     */
    private $targetings;

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

    /**
     * ProjectionSettings constructor.
     *
     * @param Package                     $package
     * @param Campaign                    $campaign
     * @param ProjectionTargetingSettings $targetings
     * @param int                         $step
     * @param float                       $shareLimit
     *
     * @throws InvalidArgumentException
     */
    public function __construct(ProjectionTargetingSettings $targetings, $step, $shareLimit, Package $package = null, Campaign $campaign = null)
    {
        if (null === $package && null === $campaign) {
            throw new InvalidArgumentException('A package or a campaign must be defined');
        }
        $this->step = $step;
        $this->shareLimit = $shareLimit;
        $this->package = $package;
        $this->targetings = $targetings;
        $this->campaign = $campaign;
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
