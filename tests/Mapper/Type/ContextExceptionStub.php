<?php

namespace tests\Dsl\MyTarget\Mapper\Type;

use Dsl\MyTarget\Mapper\Exception\ContextUnawareException;

class ContextUnawareExceptionStub extends \Exception implements ContextUnawareException
{

}
