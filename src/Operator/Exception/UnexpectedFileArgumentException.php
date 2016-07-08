<?php

namespace MyTarget\Operator\Exception;

use MyTarget\Exception\MyTargetException;

class UnexpectedFileArgumentException extends \InvalidArgumentException
    implements MyTargetException
{
    /**
     * @param mixed $file
     */
    public function __construct($file)
    {
        parent::__construct(sprintf("Unexpected type: %s (StreamInterface, resource or file path is expected)",
            is_object($file) ? get_class($file) : gettype($file)));
    }
}
