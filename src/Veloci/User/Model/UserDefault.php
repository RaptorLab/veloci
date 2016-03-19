<?php

namespace Veloci\User\Model;

use DateTime;

use Veloci\Core\Model\DateableModel;
use Veloci\Core\Model\RichEntityModel;
use Veloci\User\User;
use Veloci\User\UserRole;

class UserDefault extends RichEntityModel implements User
{
    use DateableModel;

    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var UserRole
     */
    protected $role;

    /**
     * UserModelDefault constructor.
     *
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->role      = new UserRoleDefault();
    }

    /**
     * @return bool
     */
    public function isEnabled():bool
    {
        return $this->enabled;
    }

    /**
     * @return UserRole
     */
    public function getRole()
    {
        return $this->role;
    }

    public function setRole(UserRole $role)
    {
        $this->role = $role;
    }

    public function enable()
    {
        $this->enabled = true;
    }

    public function disable()
    {
        $this->enabled = false;
    }
}