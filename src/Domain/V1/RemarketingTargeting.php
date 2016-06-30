<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\Hydrated;
use MyTarget\DomainFactory;
use MyTarget\Util\DataAccess\DataAccess;

class RemarketingTargeting extends Hydrated
{
    /** @var int */
    private $scoreThreshold;

    /**
     * @inheritdoc
     */
    public function load(DataAccess $data, DomainFactory $factory)
    {
        $this->scoreThreshold = $data->getOrNull("score_threshold");
    }

    /**
     * @inheritdoc
     */
    public function unload()
    {
        return ["score_threshold" => $this->scoreThreshold];
    }
}
