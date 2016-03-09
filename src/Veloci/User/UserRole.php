<?php

namespace Veloci\User;

use Veloci\Core\Model\Model;

interface UserRole extends Model {
	/**
	 * @return string
	 */
	public function getName ();
}