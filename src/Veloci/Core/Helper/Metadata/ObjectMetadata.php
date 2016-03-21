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

    public function __construct($object)
    {
        $this->reflectionClass = new ReflectionClass($object);

        $this->type = is_string($object) ? $object : get_class($object);
    }

    /**
     * @return ReflectionClass
     */
    public function getReflectionClass():ReflectionClass
    {
        return $this->reflectionClass;
    }

    /**
     * @return PropertyMetadata[]
     */
    public function getProperties():array
    {
        return $this->properties;
    }

    public function getMethods():array
    {
        return $this->reflectionClass->getMethods();
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

    public function hasMethod($name)
    {
        return $this->reflectionClass->hasMethod($name);
    }
}