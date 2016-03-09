<?php

namespace Veloci\Core\Factory;

use Veloci\Core\Model\Model;

interface ModelFactory {
	/**
	 * @return Model
	 */
	public function create();
}