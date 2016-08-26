<?php

namespace Dsl\MyTarget\Transport\Exception;

use Dsl\MyTarget\Exception\ApiException;

class ServerErrorException extends RequestException
    implements ApiException
{
}
