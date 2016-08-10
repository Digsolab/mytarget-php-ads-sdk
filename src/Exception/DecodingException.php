<?php

namespace Dsl\MyTarget\Exception;

use Dsl\MyTarget\Exception\ApiException;

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
