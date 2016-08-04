<?php

namespace MyTarget\Domain\V1\Targeting;

use MyTarget\Mapper\Annotation\Field;

class Fulltime
{
    /**
     * @var int[]
     * @Field(name="sun", type="array<int>")
     */
    private $sun;

    /**
     * @var int[]
     * @Field(name="mon", type="array<int>")
     */
    private $mon;

    /**
     * @var int[]
     * @Field(name="tue", type="array<int>")
     */
    private $tue;

    /**
     * @var int[]
     * @Field(name="wed", type="array<int>")
     */
    private $wed;

    /**
     * @var int[]
     * @Field(name="thu", type="array<int>")
     */
    private $thu;

    /**
     * @var int[]
     * @Field(name="fri", type="array<int>")
     */
    private $fri;

    /**
     * @var int[]
     * @Field(name="sat", type="array<int>")
     */
    private $sat;

    /**
     * @var string[]
     * @Field(name="flags", type="array<string>")
     */
    private $flags;

    /**
     * @param \int[] $sun
     * @param \int[] $mon
     * @param \int[] $tue
     * @param \int[] $wed
     * @param \int[] $thu
     * @param \int[] $fri
     * @param \int[] $sat
     * @param \string[] $flags
     *
     * @return Fulltime
     */
    public function create(array $sun, array $mon, array $tue, array $wed, array $thu, array $fri, array $sat, array $flags)
    {
        $self = new Fulltime();
        $self->sun = $sun;
        $self->mon = $mon;
        $self->tue = $tue;
        $self->wed = $wed;
        $self->thu = $thu;
        $self->fri = $fri;
        $self->sat = $sat;
        $self->flags = $flags;

        return $self;
    }

    /**
     * @param \int[] $sun
     */
    public function setSun($sun)
    {
        $this->sun = $sun;
    }

    /**
     * @param \int[] $mon
     */
    public function setMon($mon)
    {
        $this->mon = $mon;
    }

    /**
     * @param \int[] $tue
     */
    public function setTue($tue)
    {
        $this->tue = $tue;
    }

    /**
     * @param \int[] $wed
     */
    public function setWed($wed)
    {
        $this->wed = $wed;
    }

    /**
     * @param \int[] $thu
     */
    public function setThu($thu)
    {
        $this->thu = $thu;
    }

    /**
     * @param \int[] $fri
     */
    public function setFri($fri)
    {
        $this->fri = $fri;
    }

    /**
     * @param \int[] $sat
     */
    public function setSat($sat)
    {
        $this->sat = $sat;
    }

    /**
     * @param \string[] $flags
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;
    }

    /**
     * @return \int[]
     */
    public function getSun()
    {
        return $this->sun;
    }

    /**
     * @return \int[]
     */
    public function getMon()
    {
        return $this->mon;
    }

    /**
     * @return \int[]
     */
    public function getTue()
    {
        return $this->tue;
    }

    /**
     * @return \int[]
     */
    public function getWed()
    {
        return $this->wed;
    }

    /**
     * @return \int[]
     */
    public function getThu()
    {
        return $this->thu;
    }

    /**
     * @return \int[]
     */
    public function getFri()
    {
        return $this->fri;
    }

    /**
     * @return \int[]
     */
    public function getSat()
    {
        return $this->sat;
    }

    /**
     * @return \string[]
     */
    public function getFlags()
    {
        return $this->flags;
    }
}
