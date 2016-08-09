<?php

namespace Dsl\MyTarget\Domain\V1\Statistic;

use Dsl\MyTarget\Mapper\Annotation\Field;

abstract class ObjectStat
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var StatisticRow
     * @Field(type="Dsl\MyTarget\Domain\V1\Statistic\StatisticRow")
     */
    private $total;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return StatisticRow
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return DatedStat[]
     */
    public abstract function getDetailed();
}
