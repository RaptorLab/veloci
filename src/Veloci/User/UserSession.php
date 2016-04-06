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
    public function getUserToken():UserToken;
}
