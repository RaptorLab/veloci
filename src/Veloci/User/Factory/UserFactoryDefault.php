<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 06/03/16
 * Time: 16:22
 */

namespace Veloci\User\Factory;

use Veloci\User\Model\UserDefault;
use Veloci\User\User;

class UserFactoryDefault implements UserFactory
{
    /**
     * @return User
     */
    public function create()
    {
        return new UserDefault(uniqid('user_', true));
    }
}