<?php

namespace Veloci\User\Repository;

use Doctrine\Common\Collections\Criteria;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\MongoDbManager;
use Veloci\Core\Repository\MongoDbRepository;
use Veloci\User\Factory\UserSessionFactory;
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 15:04
 */
class MongoDbUserSessionRepository extends MongoDbRepository implements UserSessionRepository
{
    /**
     * @var UserSessionFactory
     */
    private $factory;
    /**
     * @var ModelSerializer
     */
    private $serializer;

    public function __construct(MongoDbManager $db, ModelSerializer $serializer, UserSessionFactory $factory)
    {
        parent::__construct($db, $serializer);

        $this->factory    = $factory;
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @param bool $fullHydration
     * @return EntityModel
     */
    public function create(array $data = [], bool $fullHydration = false):EntityModel
    {
        return $this->factory->create($data, $fullHydration);
    }

    /**
     * @return string
     */
    protected function getCollectionName():string
    {
        return 'user_sessions';
    }

    public function serialize(EntityModel $model):array
    {
        return $this->serializer->serialize($model);
    }

    public function deserialize(array $data):EntityModel
    {
        return $this->factory->create($data);
    }

    /**
     * @param User $user
     * @return UserSession
     */
    public function getByUser(User $user)
    {
        $criteria = Criteria::create();
        $expr     = Criteria::expr();

        $criteria->where($expr->eq('userId', $user->getId()));

        $sessions = $this->getAll($criteria)->toArray();

        if (count($sessions) > 0) {
            return $this->factory->create($sessions[0], true);
        }

        return null;
    }

    /**
     * @param \Veloci\Core\Model\EntityModel $model
     * @return boolean
     */
    public function accept(EntityModel $model):bool
    {
        return $model instanceof UserSession;
    }
}