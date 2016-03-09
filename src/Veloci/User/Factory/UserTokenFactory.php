<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:11
 */

namespace Veloci\User\Factory;

use Veloci\User\User;

interface UserTokenFactory
{
    public function create(User $user);
}