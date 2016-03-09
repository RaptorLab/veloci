<?php

namespace Veloci\Core\Manager;

use Veloci\Core\Router\Route;

interface PackageManager {
	/**
	 * @param Route $route
	 */
	public function registerRoute(Route $route);

	/**
	 * @param string $name
	 * @param mixed $generator
	 */
	public function registerClass($name, $generator);
}