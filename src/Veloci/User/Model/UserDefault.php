<?php

namespace Veloci\User\Model;

use DateTime;

use Veloci\Core\Model\DateableModel;
use Veloci\User\User;
use Veloci\User\UserRole;

class UserDefault implements User
{
    use DateableModel;

    /**
     * @var mixed
     */
    private $id;


    /**
     * @var bool
     */
    private $enabled;

    /**
     * UserModelDefault constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id ?: 0;

        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();

        $this->enabled = false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }


    /**
     * @return UserRole
     */
    public function getRole()
    {
        return new UserRoleDefault();
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