<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\User\Repository;

use Veloci\Core\Repository\InMemoryRepository;
use Veloci\User\User;

/**
 * Description of InMemoryUserRepository
 *
 * @author christian
 */
class InMemoryUserRepository extends InMemoryRepository implements UserRepository
{
    /**
     * @param string $username
     * @return bool
     */
    public function usernameAlreadyExists(string $username):bool
    {
        $user = $this->getUserByUsername($username);

        return $user !== null;
    }

    /**
     * @param string $username
     * @return User | null
     */
    public function getUserByUsername(string $username)
    {
        $users = $this->getAll();

        /** @var User $user */
        foreach ($users as $user) {
            if ($user->getUsername() === $username) {
                return $user;
            }
        }

        return null;
    }

    protected function getModelClass():string
    {
        return User::class;
    }
}
