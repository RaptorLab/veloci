<?php

namespace Veloci\User\Repository;

use Doctrine\Common\Collections\Criteria;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Core\Model\EntityModel;
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
    /**
     * @var ModelSerializer
     */
    private $serializer;

    public function __construct(MongoDbManager $db, ModelSerializer $serializer, UserFactory $factory)
    {
        parent::__construct($db, $serializer);

        $this->factory    = $factory;
        $this->serializer = $serializer;
    }

    /**
     * @return User
     */
    public function create(array $data = []):User
    {
        return $this->factory->create($data);
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
        $user = $this->getUserByUsername($username);

        return $user !== null;
    }

    public function serialize(EntityModel $model):array
    {
        return $this->serializer->serialize($model);
    }

    public function deserialize(array $data):EntityModel
    {
        return $this->factory->create($data, true);
    }

    /**
     * @param string $username
     * @return User | null
     */
    public function getUserByUsername(string $username)
    {
        $criteria = Criteria::create();
        $expr     = Criteria::expr();

        $criteria->where($expr->eq('username', $username));

        $users = $this->getAll($criteria)->toArray();

        if (count($users) > 0) {
            return $this->deserialize($users[0]);
        }

        return null;
    }

    /**
     * @param \Veloci\Core\Model\EntityModel $model
     * @return boolean
     */
    public function accept(EntityModel $model):bool
    {
        return $model instanceof User;
    }
}