<?php

namespace MyTarget\Transport\Middleware\Impl\Exception;

use MyTarget\Exception\MyTargetException;

class ThrottleException extends \RuntimeException
    implements MyTargetException
{

}
