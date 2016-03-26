<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\User\Repository;

use Veloci\Core\Helper\Serializer\ModelSerializer;
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
     * @var ModelSerializer
     */
    private $modelSerializer;

    /**
     * InMemoryUserRepository constructor.
     * @param UserFactory $userFactory
     */
    public function __construct(UserFactory $userFactory, ModelSerializer $modelSerializer)
    {
        parent::__construct();

        $this->userFactory     = $userFactory;
        $this->modelSerializer = $modelSerializer;
    }

    public function accept(EntityModel $model):bool
    {
        return $model instanceof User;
    }

    /**
     * @return User
     */
    public function create(array $data = []):User
    {
        return $this->userFactory->create($data);
    }

    /**
     * @param string $username
     * @return bool
     */
    public function usernameAlreadyExists(string $username):bool
    {
        $user = $this->getUserByUsername($username);

        return $user !== null;
    }

    public function serialize(EntityModel $model):array
    {
        return $this->modelSerializer->serialize($model);
    }

    public function deserialize(array $data):EntityModel
    {
        return $model = $this->userFactory->create($data);
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
}
