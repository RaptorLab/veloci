<?php

namespace Veloci\Core\Package;


use Veloci\Core\Helper\DependencyInjectionContainer;

abstract class Package
{

    /**
     * @var DependencyInjectionContainer
     */
    protected $container;

    /**
     * Package constructor.
     *
     * @param DependencyInjectionContainer $container
     */
    public function __construct(DependencyInjectionContainer $container)
    {
        $this->container = $container;

        $this->init();
    }

    /**
     *
     */
    abstract protected function init();

    protected function registerRepository($type, $interface, $class)
    {
        if (env('DB_CONNECTION', 'mongodb') === $type) {
            $this->container->registerClass($interface, $class);
        }
    }
}