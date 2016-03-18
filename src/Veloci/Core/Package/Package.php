<?php

namespace Veloci\Core\Package;

use Veloci\Core\Router\Router;
use Veloci\Core\Helper\DependencyInjectionContainer;

abstract class Package {

	/**
	 * @var Router
	 */
	protected $router;

	/**
	 * @var DependencyInjectionContainer
	 */
	protected $container;

	/**
	 * Package constructor.
	 * @param Router $router
	 * @param DependencyInjectionContainer $container
	 */
	public function __construct(Router $router, DependencyInjectionContainer $container) {
		$this->router    = $router;
		$this->container = $container;

		$this->init();
	}

	/**
	 *
	 */
	abstract protected function init();

	protected function registerRepository ($type, $interface, $class) {
		if (env('DB_DRIVER') === $type) {
			$this->container->registerClass($interface, $class);
		}
	}
}