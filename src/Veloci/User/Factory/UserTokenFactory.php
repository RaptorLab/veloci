<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:11
 */

namespace Veloci\User\Factory;

use Veloci\User\User;
use Veloci\User\UserToken;

interface UserTokenFactory
{
    /**
     * @param User $user
     * @return UserToken
     */
    public function create(User $user):UserToken;
}