<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:19
 */

namespace Veloci\User\Factory;


use Veloci\Core\Model\Model;
use Veloci\User\Model\UserSessionDefault;
use Veloci\User\User;
use Veloci\User\UserToken;

class UserSessionFactoryDefault implements UserSessionFactory
{
    /**
     * @param User $user
     * @param UserToken $userToken
     * @return Model
     */
    public function create(User $user, UserToken $userToken)
    {
        return new UserSessionDefault($userToken, $user);
    }
}