<?php

namespace MyTarget\Util\DataAccess;

class SomeData implements DataAccess
{
    /**
     * @var mixed
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @inheritdoc
     */
    public function peek($key)
    {
        return is_array($this->data) && isset($this->data[$key])
            ? new SomeData($this->data[$key]) : new NoData();
    }

    /**
     * @inheritdoc
     */
    public function getOrNull($key)
    {
        return $this->peek($key)->unwrap();
    }

    /**
     * @inheritdoc
     */
    public function map(callable $callable)
    {
        return new SomeData($callable($this->data));
    }

    /**
     * @return mixed
     */
    public function unwrap()
    {
        return $this->data;
    }
}
