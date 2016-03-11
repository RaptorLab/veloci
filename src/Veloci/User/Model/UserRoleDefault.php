<?php

namespace Veloci\User\Model;

use Veloci\User\UserRole;

class UserRoleDefault implements UserRole {
	/**
	 * @return string
	 */
	public function getName() {
		return 'admin';
	}
}