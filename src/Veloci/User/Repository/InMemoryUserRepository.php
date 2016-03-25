<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\User\Repository;

use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\InMemoryRepository;
use Veloci\User\Factory\UserFactory;
use Veloci\User\User;

/**
 * Description of InMemoryUserRepository
 *
 * @author christian
 */
class InMemoryUserRepository extends InMemoryRepository implements UserRepository
{
    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * InMemoryUserRepository constructor.
     * @param UserFactory $userFactory
     */
    public function __construct(UserFactory $userFactory)
    {
        parent::__construct();

        $this->userFactory = $userFactory;
    }

    public function accept(EntityModel $model):bool
    {
        return $model instanceof User;
    }

    /**
     * @return User
     */
    public function create():EntityModel
    {
        return $this->userFactory->create();
    }

    /**
     * @param string $username
     * @return bool
     */
    public function usernameAlreadyExists(string $username):bool
    {
        $users = $this->getAll();

        /** @var User $user */
        foreach ($users as $user) {
            if($user->getUsername() === $username) {
                return true;
            }
        }

        return false;
    }
}
