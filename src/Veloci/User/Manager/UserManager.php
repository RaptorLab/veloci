<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\User\Manager;

use Veloci\User\User;

/**
 *
 * @author christian
 */
interface UserManager {

    /**
     * @return User
     */
    public function create(array $data = []):User;

    /**
     * @param User $user
     */
    public function signup(User $user);

    /**
     * @param User $user
     */
    public function enable(User $user);

    /**
     * @param User $user
     */
    public function disable(User $user);

    /**
     * @param User $user
     * @return boolean
     */
    public function exists(User $user):bool;
}
