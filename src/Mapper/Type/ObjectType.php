<?php

namespace Dsl\MyTarget\Mapper\Type;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Instantiator\Instantiator;
use Doctrine\Instantiator\InstantiatorInterface;
use Dsl\MyTarget\Mapper\Annotation\Field;
use Dsl\MyTarget\Mapper\Exception\ContextAwareException;
use Dsl\MyTarget\Mapper\Exception\ContextUnawareException;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Mapper\Exception\ClassNotFoundException;

class ObjectType implements Type
{
    /**
     * @var InstantiatorInterface
     */
    private $instantiator;

    /**
     * @var Reader
     */
    private $annotations;

    public function __construct(Reader $annotations, InstantiatorInterface $instantiator = null)
    {
        $this->annotations = $annotations;
        $this->instantiator = $instantiator ?: new Instantiator();
    }

    /**
     * @inheritdoc
     */
    public function hydrated($value, $type, Mapper $mapper)
    {
        if ( ! class_exists($type)) {
            throw new ClassNotFoundException($type);
        }

        $class = new \ReflectionClass($type);
        $result = $this->instantiator->instantiate($type);

        do {
            foreach ($class->getProperties() as $property) {

                if ($property->class !== $class->getName()) {
                    continue;
                }

                $field = $this->annotations->getPropertyAnnotation($property, Field::class);

                if ($field instanceof Field) {
                    $fieldName = $field->name ?: $property->getName();

                    if (isset($value[$fieldName])) {
                        try {
                            $hydrated = $mapper->hydrateNew($field->type, $value[$fieldName]);
                        } catch (ContextUnawareException $e) {
                            throw new ContextAwareException($class->getName(), $property->getName(), $e);
                        }

                        $property->setAccessible(true);
                        $property->setValue($result, $hydrated);
                    }
                }
            }
        } while ($class = $class->getParentClass());

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function snapshot($value, $type, Mapper $mapper)
    {
        $class = new \ReflectionClass($value);
        $result = [];

        do {
            foreach ($class->getProperties() as $property) {
                $property->setAccessible(true);
                $propertyValue = $property->getValue($value);

                $field = $this->annotations->getPropertyAnnotation($property, Field::class);

                if ($field instanceof Field) {
                    $fieldName = $field->name ?: $property->getName();

                    $eachValue = $propertyValue === null
                        ? null
                        : $mapper->snapshot($propertyValue, $field->type);

                    if ($eachValue !== null || $field->nullable) {
                        $result[$fieldName] = $eachValue;
                    }
                }
            }
        } while ($class = $class->getParentClass());

        if ( ! $result) {
            return null;
        }

        return $result;
    }
}
