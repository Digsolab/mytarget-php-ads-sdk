<?php

namespace MyTarget\Domain;

use MyTarget\DomainFactory;
use MyTarget\Util\DataAccess\DataAccess;

abstract class Hydrated
{
    /**
     * @var array
     */
    private $original;

    /**
     * @param DataAccess $data
     * @param DomainFactory $factory
     */
    public abstract function load(DataAccess $data, DomainFactory $factory);

    /**
     * @return array
     */
    public abstract function unload();

    /**
     * @return array|null
     */
    public function export()
    {
        $everything = $this->unload();

        return \MyTarget\arraySubtract($everything, $this->original) ?: null;
    }
}
