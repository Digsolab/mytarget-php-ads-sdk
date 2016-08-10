<?php

namespace Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Mapper\Mapper;

class DateTimeType implements Type
{
    /**
     * @var \DateTimeZone
     */
    private $tz;

    public function __construct(\DateTimeZone $tz = null)
    {
        $this->tz = $tz ?: new \DateTimeZone("Europe/Moscow");
    }

    /**
     * @inheritdoc
     */
    public function hydrated($value, $type, Mapper $mapper)
    {
        if (strpos($type, "<") !== false && preg_match('!^DateTime\<(?<format>.+?)\>$!', $type, $tParam)) {
            return \DateTimeImmutable::createFromFormat($tParam["format"], $value, $this->tz) ?: null;
        }

        return \DateTimeImmutable::createFromFormat("Y-m-d H:i:s", $value, $this->tz) ?: null;
    }

    /**
     * @inheritdoc
     */
    public function snapshot($value, $type, Mapper $mapper)
    {
        if ( ! $value instanceof \DateTimeInterface) {
            return null;
        }

        if (strpos($type, "<") !== false && preg_match('!^DateTime\<(?<format>.+?)\>$!', $type, $tParam)) {
            return $value->format($tParam["format"]);
        }

        return $value->format("Y-m-d H:i:s");
    }
}
