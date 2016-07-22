<?php

namespace MyTarget\Token\Exception;

use MyTarget\Exception\MyTargetException;

class TokenLimitReachedException extends \RuntimeException implements MyTargetException
{
}
