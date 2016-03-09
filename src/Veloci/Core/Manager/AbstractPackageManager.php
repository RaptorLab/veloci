<?php

namespace Veloci\Core\Manager;

use Veloci\Core\Router\Router;
use Veloci\Core\Router\Route;
use Veloci\Core\Helper\DependencyInjectionContainer;

abstract class AbstractPackageManager implements PackageManager
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var DependencyInjectionContainer
     */
    protected $container;

    /**
     * AbstractPackageManager constructor.
     * @param Router $router
     * @param DependencyInjectionContainer $container
     */
    public function __construct(Router $router, DependencyInjectionContainer $container)
    {
        $this->router    = $router;
        $this->container = $container;
    }

    /**
     * @param Route $route
     */
    public function registerRoute(Route $route)
    {
        $this->router->register($route);
    }

    /**
     * @param string $name
     * @param mixed $generator
     */
    public function registerClass($name, $generator)
    {

    }
}