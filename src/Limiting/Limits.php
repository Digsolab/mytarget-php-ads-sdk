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
            'moment'    => $this->moment,
            'by_second' => $this->bySecond,
            'by_minute' => $this->byMinute,
            'by_hour'   => $this->byHour,
            'by_day'    => $this->byDay,
        ];
    }
}
