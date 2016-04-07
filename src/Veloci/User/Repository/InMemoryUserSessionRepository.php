<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 01:47
 */

namespace Veloci\User\Repository;


use Veloci\Core\Repository\InMemoryRepository;
use Veloci\User\Factory\UserSessionFactory;
use Veloci\User\User;
use Veloci\User\UserSession;

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
     * @param User $user
     * @return UserSession
     */
    public function getByUser(User $user)
    {
        $userSession = $this->getBy(function (UserSession $userSession) use ($user) {
            return $userSession->getUser()->getId() === $user->getId();
        })->first();

        return $userSession ?: null;
    }

    protected function getModelClass():string
    {
        return UserSessionFactory::class;
    }
}