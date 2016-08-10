<?php

namespace Dsl\MyTarget\Transport\Exception;

use Dsl\MyTarget\Exception\ApiException;

class RedirectUnexpectedException extends RequestException
    implements ApiException
{
}
