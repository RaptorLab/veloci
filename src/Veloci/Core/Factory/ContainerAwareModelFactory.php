<?php

namespace Veloci\Core\Factory;

use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Core\Model\EntityModel;

abstract class ContainerAwareModelFactory implements ModelFactory
{
    /**
     * @var DependencyInjectionContainer $container
     */
    private $container;

    /**
     * @var string
     */
    private $className;
    /**
     * @var ModelSerializer
     */
    private $serializer;

    /**
     * ContainerAwareFactory constructor.
     * @param DependencyInjectionContainer $container
     * @param ModelSerializer $serializer
     * @param string $className
     */
    public function __construct(DependencyInjectionContainer $container, ModelSerializer $serializer, $className)
    {
        $this->container  = $container;
        $this->className  = $className;
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @return mixed
     *
     * @throws \RuntimeException
     */
    final public function create(array $data = []):EntityModel
    {
        $model = $this->container->get($this->className);

        if ($model === null) {
            throw new \RuntimeException ('Cannot create a new instance of ' . $this->className);
        }

        $this->serializer->hydrate($data, $model);

        return $model;

    }
}