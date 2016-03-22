<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 03:15
 */

namespace Veloci\User\Manager;


use Veloci\User\User;
use Veloci\User\UserSession;

interface AuthManager
{
    /**
     * @param User $user
     *
     * @return UserSession
     */
    public function login (User $user):UserSession;

    /**
     * @param UserSession $userSession
     */
    public function logout (UserSession $userSession);

    /**
     * @param User $user
     * @return bool
     */
    public function isLogged(User $user):bool;
}