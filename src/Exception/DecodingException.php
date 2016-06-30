<?php

namespace MyTarget\Exception;

class DecodingException extends \RuntimeException
    implements MyTargetException
{
    /**
     * @param string $decodingError
     */
    public function __construct($decodingError)
    {
        parent::__construct($decodingError);
    }
}
