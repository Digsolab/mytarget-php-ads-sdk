<?php

namespace Dsl\MyTarget\Exception;

class DecodingException extends \RuntimeException
    implements MyTargetException, ApiException
{
    /**
     * @param string $decodingError
     */
    public function __construct($decodingError)
    {
        parent::__construct($decodingError);
    }
}
