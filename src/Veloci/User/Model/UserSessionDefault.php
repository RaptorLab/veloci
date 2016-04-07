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
    protected $token;


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
    public function getToken():UserToken
    {
        return $this->token;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param UserToken $token
     */
    public function setToken(UserToken $token)
    {
        $this->token = $token;
    }
}