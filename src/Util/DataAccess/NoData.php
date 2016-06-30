<?php

namespace MyTarget\Util\DataAccess;

class NoData implements DataAccess
{
    /**
     * @inheritdoc
     */
    public function peek($key)
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOrNull($key)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function map(callable $callable)
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function unwrap()
    {
        return null;
    }
}
