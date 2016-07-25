<?php

namespace MyTarget\Limiting;

class Limits
{
    /**
     * @var \DateTimeInterface
     */
    public $moment;

    /**
     * @var int
     */
    public $bySecond = null;

    /**
     * @var int
     */
    public $byMinute = null;

    /**
     * @var int
     */
    public $byHour = null;

    /**
     * @var int
     */
    public $byDay = null;

    /**
     * @param \DateTimeInterface $moment
     * @param int|null $bySecond
     * @param int|null $byMinute
     * @param int|null $byHour
     * @param int|null $byDay
     *
     * @return Limits
     */
    public static function create(\DateTimeInterface $moment, $bySecond, $byMinute, $byHour, $byDay)
    {
        $self = new Limits();
        $self->moment = $moment;
        $self->bySecond = $bySecond;
        $self->byMinute = $byMinute;
        $self->byHour = $byHour;
        $self->byDay = $byDay;

        return $self;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'moment'    => $this->moment->format(\DateTime::ISO8601),
            'by_second' => $this->bySecond,
            'by_minute' => $this->byMinute,
            'by_hour'   => $this->byHour,
            'by_day'    => $this->byDay,
        ];
    }

    /**
     * @param array $limitsArray
     *
     * @return Limits
     */
    public static function buildFromArray(array $limitsArray)
    {
        $limits = new self();

        $limits->moment = isset($limitsArray['moment']) ? new \DateTimeImmutable($limitsArray['moment']) : null;
        $limits->bySecond = isset($limitsArray['by_second']) ? $limitsArray['by_second'] : null;
        $limits->byMinute = isset($limitsArray['by_minute']) ? $limitsArray['by_minute'] : null;
        $limits->byHour = isset($limitsArray['by_hour']) ? $limitsArray['by_hour'] : null;
        $limits->byDay = isset($limitsArray['by_day']) ? $limitsArray['by_day'] : null;

        return $limits;
    }
}
