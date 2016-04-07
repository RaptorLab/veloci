<?php

namespace Veloci\User\Repository;

use Doctrine\Common\Collections\Criteria;
use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\MongoDbRepository;
use Veloci\User\User;
use Veloci\User\UserSession;

/**
 * Created by PhpStorm.
 * User: christian
 * Date: 09/03/16
 * Time: 15:04
 */
class MongoDbUserSessionRepository extends MongoDbRepository implements UserSessionRepository
{
    /**
     * @return string
     */
    protected function getCollectionName():string
    {
        return 'user_sessions';
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

        $sessions = $this->getAll($criteria, true);

        return $sessions->getNextElement();
    }

    /**
     * @param \Veloci\Core\Model\EntityModel $model
     * @return boolean
     */
    public function accept(EntityModel $model):bool
    {
        return $model instanceof UserSession;
    }

    protected function getModelClass():string
    {
        return UserSession::class;
    }
}