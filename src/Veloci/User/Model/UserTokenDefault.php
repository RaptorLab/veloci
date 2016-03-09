<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:08
 */

namespace Veloci\User\Model;


use Veloci\User\UserToken;
use Veloci\User\User;

class UserTokenDefault implements UserToken
{
    private $token;

    public function __construct(User $user)
    {
        $this->token = md5(uniqid($user->getId(), true));
    }

    public function __toString()
    {
        return $this->token;
    }
}