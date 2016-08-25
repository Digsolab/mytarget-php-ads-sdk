<?php

namespace MyTarget\Operator\V1\Fields;

use Dsl\MyTarget\Domain\V1\Enum\Status;
use Dsl\MyTarget as f;

class BannerRequest
{
    /**
     * @var int[]|null
     */
    private $ids;

    /**
     * @var Status[]|null
     */
    private $withStatuses;

    /**
     * @var Status[]|null
     */
    private $withCampaignStatuses;

    /**
     * @var \DateTimeImmutable|null
     */
    private $statsChangedAfter;

    /**
     * @var \DateTimeImmutable|null
     */
    private $updatedAfter;

    /**
     * @param int[]|null $ids
     * @param Status[]|null $withStatuses
     * @param Status[]|null $withCampaignStatuses
     * @param \DateTimeInterface|null $statsChangedAfter
     * @param \DateTimeInterface|null $updatedAfter
     */
    public function __construct(array $ids = null, array $withStatuses = null, array $withCampaignStatuses = null,
        \DateTimeInterface $statsChangedAfter = null, \DateTimeInterface $updatedAfter = null)
    {
        $this->ids = $ids;
        $this->withStatuses = $withStatuses;
        $this->withCampaignStatuses = $withCampaignStatuses;
        $this->statsChangedAfter = $statsChangedAfter ? f\date_immutable($statsChangedAfter) : null;
        $this->updatedAfter = $updatedAfter ? f\date_immutable($updatedAfter) : null;
    }

    /**
     * @return BannerRequest
     */
    public static function create()
    {
        return new BannerRequest();
    }

    /**
     * @param int[] $ids
     * @return BannerRequest
     */
    public function withIds(array $ids)
    {
        $self = clone $this;
        $self->ids = $ids;

        return $self;
    }

    /**
     * @param Status[] $statuses
     * @return BannerRequest
     */
    public function withStatuses(array $statuses)
    {
        $self = clone $this;
        $self->withStatuses = $statuses;

        return $self;
    }

    /**
     * @param Status[] $campaignStatuses
     * @return BannerRequest
     */
    public function withCampaignStatuses(array $campaignStatuses)
    {
        $self = clone $this;
        $self->withCampaignStatuses = $campaignStatuses;

        return $self;
    }

    /**
     * @param \DateTimeInterface $moment
     * @return BannerRequest
     */
    public function withStatsChangedAfter(\DateTimeInterface $moment)
    {
        $self = clone $this;
        $self->statsChangedAfter = f\date_immutable($moment);

        return $self;
    }

    /**
     * @param \DateTimeInterface $moment
     * @return BannerRequest
     */
    public function withUpdatedAfter(\DateTimeInterface $moment)
    {
        $self = clone $this;
        $self->updatedAfter = f\date_immutable($moment);

        return $self;
    }

    /**
     * @return int[]|null
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @return Status[]|null
     */
    public function getWithStatuses()
    {
        return $this->withStatuses;
    }

    /**
     * @return Status[]|null
     */
    public function getWithCampaignStatuses()
    {
        return $this->withCampaignStatuses;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getStatsChangedAfter()
    {
        return $this->statsChangedAfter;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAfter()
    {
        return $this->updatedAfter;
    }
}
