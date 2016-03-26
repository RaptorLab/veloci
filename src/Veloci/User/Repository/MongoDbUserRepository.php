<?php

namespace Veloci\User\Repository;

use Doctrine\Common\Collections\Criteria;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Core\Repository\MongoDbManager;
use Veloci\Core\Repository\MongoDbRepository;
use Veloci\User\Factory\UserFactory;
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
     * @var UserFactory
     */
    private $factory;

    public function __construct(MongoDbManager $db, ModelSerializer $serializer, UserFactory $factory)
    {
        parent::__construct($db, $serializer);

        $this->factory = $factory;
    }

    /**
     * @return User
     */
    public function create():User
    {
        return $this->factory->create();
    }

    /**
     * @return string
     */
    protected function getCollectionName():string
    {
        return 'users';
    }

    /**
     * @param string $username
     * @return bool
     */
    public function usernameAlreadyExists(string $username):bool
    {
        $criteria = Criteria::create();
        $expr     = Criteria::expr();

        $criteria->where($expr->eq('username', $username));

        $users = $this->getAll($criteria)->toArray();

        return count($users) > 0;
    }
}