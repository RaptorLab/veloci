<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 01:47
 */

namespace Veloci\User\Repository;


use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\InMemoryRepository;
use Veloci\User\Factory\UserSessionFactory;
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

class InMemoryUserSessionRepository extends InMemoryRepository implements UserSessionRepository
{
    /**
     * @var UserSessionFactory
     */
    private $userSessionFactory;

    /**
     * InMemoryUserSessionRepository constructor.
     *
     * @param UserSessionFactory $userSessionFactory
     */
    public function __construct(UserSessionFactory $userSessionFactory)
    {
        parent::__construct();

        $this->userSessionFactory = $userSessionFactory;
    }

    /**
     * @param EntityModel $model
     * @return boolean
     */
    public function accept(EntityModel $model)
    {
        return $model instanceof UserSession;
    }

    /**
     * @param User $user
     * @param UserToken $userToken
     * @return \Veloci\User\UserSession
     */
    public function create(User $user, UserToken $userToken)
    {
        return $this->userSessionFactory->create($user, $userToken);
    }

    /**
     * @param User $user
     * @return UserSession
     */
    public function getByUser(User $user)
    {
        $userSession = $this->getBy(function (UserSession $userSession) use ($user) {
            return $userSession->getUserId() === $user->getId();
        })->first();

        return $userSession ?: null;
    }
}