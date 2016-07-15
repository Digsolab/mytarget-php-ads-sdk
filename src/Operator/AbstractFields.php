<?php

namespace MyTarget\Operator;

abstract class AbstractFields
{
    /**
     * @var string[]
     */
    private $fields = [];

    /**
     * @return static
     */
    public static function create()
    {
        $self = new static();
        $self->fields = $self->defaultFields();

        return $self;
    }

    /**
     * @return static
     */
    public static function createEmpty()
    {
        $self = new static();
        $self->fields = [];

        return $self;
    }

    /**
     * @param string $field
     */
    public function addField($field)
    {
        $this->fields[] = $field;
    }

    /**
     * @param string[] $fields
     */
    public function addFields($fields)
    {
        $this->fields = array_merge($this->fields, $fields);
    }

    /**
     * @return string[]
     */
    public function getFields()
    {
        return array_unique($this->fields);
    }

    /**
     * @param string $field
     * @return bool
     */
    public function hasField($field)
    {
        return in_array($field, $this->fields, true);
    }

    /**
     * @param string $name
     * @param mixed $_
     *
     * @return static
     */
    public function __call($name, $_)
    {
        if (strlen($name) > 4 && strpos($name, 'with') === 0) {
            $this->fields[] = lcfirst(substr($name, 4));
        } else {
            throw new \RuntimeException("Method {$name} does not exist");
        }

        return $this;
    }

    /**
     * @return string[]
     */
    public abstract function defaultFields();
}
