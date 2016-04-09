<?php

namespace Veloci\User\Repository;

use Doctrine\Common\Collections\Criteria;


use Veloci\Core\Repository\MongoDbRepository;
use Veloci\User\User;

/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 15:04
 */
class MongoDbUserRepository extends MongoDbRepository implements UserRepository
{
    /**
     * @return string
     */
    protected function getCollectionName():string
    {
        return 'users';
    }

    protected function getModelClass():string
    {
        return User::class;
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

    /**
     * @param string $username
     * @return User | null
     */
    public function getUserByUsername(string $username, $hydrate = true)
    {
        $criteria = Criteria::create();
        $expr     = Criteria::expr();

        $criteria->where($expr->eq('username', $username));

        $users = $this->getAll($criteria, $hydrate);

        return $users->getNextElement();
    }
}