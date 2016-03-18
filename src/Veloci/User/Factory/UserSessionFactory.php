<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:18
 */

namespace Veloci\User\Factory;


use Veloci\Core\Factory\ModelFactory;
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

interface UserSessionFactory extends ModelFactory
{
    /**
     * @param User $user
     * @param UserToken $userToken
     * @return UserSession
     */
    public function create(User $user, UserToken $userToken):UserSession;
}