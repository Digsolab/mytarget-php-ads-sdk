<?php

namespace Dsl\MyTarget\Mapper\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Field extends Annotation
{
    /**
     * @var string
     */
    public $type;

    /**
     * Name in the API
     *
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $nullable = false;
}
