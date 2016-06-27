<?php

namespace MyTarget\Limiting\Exception;

use MyTarget\Exception\MyTargetException;

class ThrottleException extends \RuntimeException
    implements MyTargetException
{

}
