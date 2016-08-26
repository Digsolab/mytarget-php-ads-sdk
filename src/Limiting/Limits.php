<?php

namespace Dsl\MyTarget\Limiting;

use Dsl\MyTarget as f;

class Limits
{
    /**
     * @var \DateTimeImmutable
     */
    private $moment;

    /**
     * @var int
     */
    private $bySecond = null;

    /**
     * @var int
     */
    private $byMinute = null;

    /**
     * @var int
     */
    private $byHour = null;

    /**
     * @var int
     */
    private $byDay = null;

    /**
     * @param \DateTimeInterface $moment
     * @param int|null           $bySecond
     * @param int|null           $byMinute
     * @param int|null           $byHour
     * @param int|null           $byDay
     */
    public function __construct(\DateTimeInterface $moment, $bySecond, $byMinute, $byHour, $byDay)
    {
        $this->moment   = f\date_immutable($moment);
        $this->bySecond = $bySecond;
        $this->byMinute = $byMinute;
        $this->byHour   = $byHour;
        $this->byDay    = $byDay;
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
        if (empty($limitsArray['moment']) || ! $moment = \DateTimeImmutable::createFromFormat(\DateTime::ISO8601, $limitsArray['moment'])) {
            return null;
        }
        $bySecond = isset($limitsArray['by_second']) && is_numeric($limitsArray['by_second']) ? (int) $limitsArray['by_second'] : null;
        $byMinute = isset($limitsArray['by_minute']) && is_numeric($limitsArray['by_minute']) ? (int) $limitsArray['by_minute'] : null;
        $byHour   = isset($limitsArray['by_hour']) && is_numeric($limitsArray['by_hour']) ? (int) $limitsArray['by_hour'] : null;
        $byDay    = isset($limitsArray['by_day']) && is_numeric($limitsArray['by_day']) ? (int) $limitsArray['by_day'] : null;

        return new self($moment, $bySecond, $byMinute, $byHour, $byDay);
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getMoment()
    {
        return $this->moment;
    }

    /**
     * @return int
     */
    public function getBySecond()
    {
        return $this->bySecond;
    }

    /**
     * @return int
     */
    public function getByMinute()
    {
        return $this->byMinute;
    }

    /**
     * @return int
     */
    public function getByHour()
    {
        return $this->byHour;
    }

    /**
     * @return int
     */
    public function getByDay()
    {
        return $this->byDay;
    }

}
