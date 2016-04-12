<?php

namespace Veloci\User\Model;



use Veloci\Core\Helper\Metadata\Domain\StringDomain;
use Veloci\Core\Helper\Metadata\ObjectMetadata;

use Veloci\Core\Model\RichEntityModel;
use Veloci\User\User;
use Veloci\User\UserRole;

class UserDefault extends RichEntityModel implements User
{

    /**
     * @var string
     */
    protected $username;


    /**
     * @var string
     */
    protected $password;

    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var string
     */
    protected $role;

    /**
     * UserModelDefault constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->role = new UserRoleDefault('user');
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /**
     * @return bool
     */
    public function isEnabled():bool
    {
        return $this->enabled;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    public function setRole(string $role)
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

    static public function setCustomMetadata(ObjectMetadata $metadata)
    {
        parent::setCustomMetadata($metadata);

        $metadata->getProperty('username')
            ->setDomain(new StringDomain('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/'))
            ->setNullable(false);


        $metadata->getProperty('password')
            ->setDomain(new StringDomain('/^\w{4,}$/'))
            ->setNullable(false);

        $metadata->getProperty('createdAt')->setReadOnly(true);
        $metadata->getProperty('updatedAt')->setReadOnly(true);
    }
}