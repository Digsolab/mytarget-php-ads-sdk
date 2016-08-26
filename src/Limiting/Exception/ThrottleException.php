<?php

namespace Dsl\MyTarget\Limiting\Exception;

use Dsl\MyTarget\Transport\Exception\RequestException;
use Dsl\MyTarget\Exception\ApiException;

class ThrottleException extends RequestException
    implements ApiException
{
}
