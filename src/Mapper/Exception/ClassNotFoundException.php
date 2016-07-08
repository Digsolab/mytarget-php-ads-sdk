<?php

namespace MyTarget\Mapper\Exception;

use MyTarget\Exception\MyTargetException;

class ClassNotFoundException extends \RuntimeException
    implements MyTargetException
{
    /**
     * @var string
     */
    public $class;

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        parent::__construct(sprintf("Class %s not found", $class));

        $this->class = $class;
    }
}
