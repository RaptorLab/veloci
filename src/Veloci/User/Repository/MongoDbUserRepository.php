<?php

namespace Veloci\User\Repository;

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
}