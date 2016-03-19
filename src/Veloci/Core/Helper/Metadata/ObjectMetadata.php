<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 22:14
 */

namespace Veloci\Core\Helper\Metadata;


use ReflectionClass;


class ObjectMetadata
{
    /** @var PropertyMetadata[] */
    private $properties = [];

    /** @var ReflectionClass */
    private $reflectionClass;

    /** @var string */
    private $type;

    /**
     * @return ReflectionClass
     */
    public function getReflectionClass():ReflectionClass
    {
        return $this->reflectionClass;
    }

    /**
     * @param ReflectionClass $reflectionClass
     */
    public function setReflectionClass($reflectionClass)
    {
        $this->reflectionClass = $reflectionClass;
    }

    /**
     * @return PropertyMetadata[]
     */
    public function getProperties():array
    {
        return $this->properties;
    }

    public function addProperty(PropertyMetadata $property)
    {
        $this->properties[$property->getName()] = $property;
    }

    /**
     * @param string $propertyName
     * @param bool $raiseException
     * @return PropertyMetadata|null
     * @throws \RuntimeException
     */
    public function getProperty(string $propertyName, $raiseException = false)
    {
        if (array_key_exists($propertyName, $this->properties)) {
            return $this->properties[$propertyName];
        }

        if ($raiseException) {
            throw new \RuntimeException("Unknown $propertyName property on {$this->type}");
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @param $object
     * @param string $name
     * @param mixed $value
     */
    public function setValue($object, string $name, $value)
    {
        $property = $this->reflectionClass->getProperty($name);

        $property->setAccessible(true);
        $property->setValue($object, $value);
    }

    public function __wakeup()
    {
        $this->reflectionClass = new ReflectionClass($this->type);
    }

    public function __sleep()
    {
        return ['properties', 'type'];
    }
}