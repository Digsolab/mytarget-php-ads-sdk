<?php

namespace MyTarget\Exception;

use Exception;

class JsonDecodingException extends \RuntimeException
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
