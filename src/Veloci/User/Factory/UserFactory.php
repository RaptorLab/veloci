<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:16
 */

namespace Veloci\User\Factory;

use Veloci\User\User;

interface UserFactory
{
    /**
     * @return User
     */
    public function create();
}