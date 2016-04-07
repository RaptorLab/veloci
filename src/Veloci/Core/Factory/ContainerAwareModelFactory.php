<?php

namespace Veloci\Core\Factory;

use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Helper\Serializer\ModelHydrator;
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
     * @var ModelHydrator
     */
    private $hydrator;

    /**
     * ContainerAwareFactory constructor.
     * @param DependencyInjectionContainer $container
     * @param ModelHydrator $hydrator
     * @param string $className
     */
    public function __construct(DependencyInjectionContainer $container, ModelHydrator $hydrator, string $className)
    {
        $this->container = $container;
        $this->className = $className;
        $this->hydrator  = $hydrator;
    }

    /**
     * @param array $data
     * @param bool $fullHydration
     *
     * @return mixed|EntityModel
     *
     * @throws \RuntimeException
     */
    final public function create(array $data = [], bool $fullHydration = false):EntityModel
    {
        return $this->hydrator->hydrate($this->className, $data, $fullHydration);
    }
}