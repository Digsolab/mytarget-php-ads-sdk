<?php

namespace MyTarget\Mapper\Exception;

use MyTarget\Exception\MyTargetException;

class TypeParsingException extends \RuntimeException
    implements MyTargetException
{
    /**
     * @var string
     */
    public $type;

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        parent::__construct(sprintf("Couldn't parse type %s", $type));

        $this->type = $type;
    }
}
