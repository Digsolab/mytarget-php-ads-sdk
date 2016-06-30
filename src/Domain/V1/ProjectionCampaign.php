<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class ProjectionCampaign extends Campaign
{
    /**
     * @var User
     * @Field(type="MyTarget\Domain\V1\User")
     */
    private $user;

    public function __construct(Package $package, CampaignTargeting $targeting, User $user)
    {
        $this->setPackage($package);
        $this->setTargetings($targeting);

        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
