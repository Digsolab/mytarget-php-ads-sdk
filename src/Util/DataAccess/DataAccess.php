<?php

namespace MyTarget\Util\DataAccess;

interface DataAccess
{
    /**
     * Returns DataAccess wrapped element by the $key. If the element doesn't exist
     * EmptyData will be returned.
     *
     * @param string|int $key
     * @return DataAccess
     */
    public function peek($key);

    /**
     * Gets $key from array and returns unwrapped value or null if $key does not exist.
     *
     * @param string|int $key
     * @return mixed
     */
    public function getOrNull($key);

    /**
     * Maps a function over value if there is one, or does nothing and returns
     * DataAccess.
     *
     * @param callable $callable
     * @return DataAccess
     */
    public function map(callable $callable);

    /**
     * Returns naked value that was decorated by the DataAccess (null if it's EmptyData)
     *
     * @return mixed
     */
    public function unwrap();
}
