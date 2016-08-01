<?php

namespace tests\MyTarget\Mapper\Type;

use MyTarget\Mapper\Exception\ContextUnawareException;

class ContextUnawareExceptionStub extends \Exception implements ContextUnawareException
{

}
