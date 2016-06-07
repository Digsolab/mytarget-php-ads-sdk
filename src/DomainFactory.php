<?php

namespace MyTarget;

use Doctrine\Instantiator\InstantiatorInterface;
use MyTarget\Domain\Hydrated;
use MyTarget\Util\DataAccess\SomeData;

class DomainFactory
{
    /**
     * @var InstantiatorInterface
     */
    private $instantiator;

    public function __construct(InstantiatorInterface $instantiator)
    {
        $this->instantiator = $instantiator;
    }

    /**
     * Makes a factory out of a $class string.
     * Return value is a callable that accepts array of data
     * and applies it to the Hydrated object.
     *
     * @param string $class
     * @return \Closure callable(array): Hydrated
     */
    public function factorize($class)
    {
        return function ($data) use ($class) {
            /** @var Hydrated $instance */
            $instance = $this->instantiator->instantiate($class);
            $instance->load(new SomeData($data), $this);

            return $instance;
        };
    }
}
