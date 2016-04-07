<?php

namespace Veloci\Core\Package;


use Veloci\Core\Configuration\PackageConfiguration;
use Veloci\Core\Helper\DependencyInjectionContainer;

abstract class Package
{

    /**
     * @var DependencyInjectionContainer
     */
    protected $container;
    /**
     * @var PackageConfiguration
     */
    private $configuration;

    /** @var string  */
    private $databaseType;

    /**
     * Package constructor.
     *
     * @param DependencyInjectionContainer $container
     */
    public function __construct(DependencyInjectionContainer $container, PackageConfiguration $configuration)
    {
        $this->container     = $container;
        $this->configuration = $configuration;

        $this->databaseType = $this->configuration->getDatabase()->getType();

        $this->init();
    }

    /**
     *
     */
    abstract protected function init();

    protected function registerRepository($type, $interface, $class)
    {
        if ($this->databaseType === $type) {
            $this->container->registerClass($interface, $class);
        }
    }
}