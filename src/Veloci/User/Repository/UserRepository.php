<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\User\Repository;

use Veloci\Core\Repository\EntityRepository;
use Veloci\User\User;

/**
 *
 * @author christian
 */
interface UserRepository extends EntityRepository
{
    /**
     * @return User
     */
    public function create();
}
