<?php

namespace Dsl\MyTarget\Transport\Exception;

use Dsl\MyTarget\Exception\ApiException;

class ClientErrorException extends RequestException
    implements ApiException
{
}
