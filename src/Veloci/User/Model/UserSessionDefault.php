<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 21/02/16
 * Time: 19:54
 */

namespace Veloci\User\Model;


use Veloci\Core\Model\RichEntityModel;
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

class UserSessionDefault extends RichEntityModel implements UserSession
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var UserToken
     */
    protected $userToken;


    /**
     * @return User
     */
    public function getUser():User
    {
        return $this->user;
    }

    /**
     * @return UserToken
     */
    public function getUserToken():UserToken
    {
        return $this->userToken;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param UserToken $userToken
     */
    public function setUserToken($userToken)
    {
        $this->userToken = $userToken;
    }
}