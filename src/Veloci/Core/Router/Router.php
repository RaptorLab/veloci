<?php

namespace Veloci\Core\Router;

interface Router {
	/**
	 * @param Route $route
	 */
	public function register(Route $route);
}