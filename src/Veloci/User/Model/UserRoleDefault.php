<?php

namespace Veloci\User\Model;

use Veloci\User\UserRole;

class UserRoleDefault implements UserRole
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}