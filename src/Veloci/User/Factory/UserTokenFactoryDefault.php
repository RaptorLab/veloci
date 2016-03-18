<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:03
 */

namespace Veloci\User\Factory;

use Veloci\User\Model\UserTokenDefault;
use Veloci\User\User;
use Veloci\User\UserToken;

class UserTokenFactoryDefault implements UserTokenFactory
{
    /**
     * @param User $user
     *
     * @return UserToken
     */
    public function create(User $user):UserToken
    {
        return new UserTokenDefault($user);
    }
}