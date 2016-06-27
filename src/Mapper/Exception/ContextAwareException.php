<?php

namespace MyTarget\Mapper\Exception;

use MyTarget\Exception\MyTargetException;

class ContextAwareException extends \RuntimeException
    implements MyTargetException
{
    public function __construct($inClass, $inField, \Exception $previous)
    {
        $message = sprintf("%s::%s - %s", $inClass, $inField, $previous->getMessage());

        parent::__construct($message, 0, $previous);
    }
}
