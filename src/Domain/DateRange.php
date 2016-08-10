<?php

namespace Dsl\MyTarget\Domain;

use Dsl\MyTarget as f;

class DateRange
{
    /**
     * @var \DateTimeImmutable
     */
    private $from;

    /**
     * @var \DateTimeImmutable
     */
    private $to;

    public function __construct(\DateTimeInterface $from, \DateTimeInterface $to)
    {
        $this->from = f\date_immutable($from);
        $this->to = f\date_immutable($to);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getTo()
    {
        return $this->to;
    }
}
