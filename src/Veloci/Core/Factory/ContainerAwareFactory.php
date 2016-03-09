<?php

namespace Veloci\Core\Factory;

use Veloci\Core\Helper\DependencyInjectionContainer;

final class ContainerAwareFactory implements ModelFactory
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
     * ContainerAwareFactory constructor.
     * @param DependencyInjectionContainer $container
     * @param string $className
     */
    public function __construct(DependencyInjectionContainer $container, $className)
    {
        $this->container = $container;
        $this->className = $className;
    }

    /**
     * @return mixed
     * @throws \RuntimeException
     */
    public function create()
    {
        $model = $this->container->get($this->className);

        if ($model !== null) {
            return $model;
        }

        throw new \RuntimeException ('Cannot create a new instance of ' . $this->className);
    }
}