<?php

namespace Veloci\User;

use Veloci\Core\Model\EntityModel;

interface UserSession extends EntityModel {

    /**
     * @return \Veloci\User\User
     */
    public function getUser():User;

    /**
     * @return UserToken
     */
    public function getToken():UserToken;

    public function setUser(User $user);

    public function setToken (UserToken $token);
}
