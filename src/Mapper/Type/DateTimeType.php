<?php

namespace MyTarget\Mapper\Type;

use MyTarget\Mapper\Mapper;

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
            return \DateTime::createFromFormat($tParam["format"], $value, $this->tz);
        }

        return \DateTime::createFromFormat("Y-m-d H:i:s", $value, $this->tz);
    }

    /**
     * @inheritdoc
     */
    public function snapshot($value, $type, Mapper $mapper)
    {
        if ( ! $value instanceof \DateTime) {
            return null;
        }

        if (strpos($type, "<") !== false && preg_match('!^DateTime\<(?<format>.+?)\>$!', $type, $tParam)) {
            return $value->format($tParam["format"]);
        }

        return $value->format("Y-m-d H:i:s");
    }
}
