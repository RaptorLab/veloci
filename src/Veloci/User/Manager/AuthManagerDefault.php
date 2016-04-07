<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 03:17
 */

namespace Veloci\User\Manager;


use Veloci\User\Exception\AuthenticationFailException;
use Veloci\User\Factory\UserSessionFactory;
use Veloci\User\Factory\UserTokenFactory;
use Veloci\User\Repository\UserRepository;
use Veloci\User\Repository\UserSessionRepository;
use Veloci\User\User;
use Veloci\User\UserSession;

class AuthManagerDefault implements AuthManager
{
    /**
     * @var UserSessionRepository
     */
    private $userSessionRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserTokenFactory
     */
    private $userTokenFactory;
    /**
     * @var UserSessionFactory
     */
    private $userSessionFactory;

    /**
     * AuthManagerDefault constructor.
     * @param UserSessionRepository $userSessionRepository
     * @param UserRepository $userRepository
     * @param UserTokenFactory $userTokenFactory
     * @param UserSessionFactory $userSessionFactory
     */
    public function __construct(
        UserSessionRepository $userSessionRepository,
        UserRepository $userRepository,
        UserTokenFactory $userTokenFactory,
        UserSessionFactory $userSessionFactory
    )
    {
        $this->userSessionRepository = $userSessionRepository;
        $this->userRepository        = $userRepository;
        $this->userTokenFactory      = $userTokenFactory;
        $this->userSessionFactory    = $userSessionFactory;
    }

    /**
     * @param User $user
     *
     * @return UserSession
     *
     * @throws AuthenticationFailException
     */
    public function login(User $user):UserSession
    {
        if (!$this->userRepository->exists($user)) {
            throw new AuthenticationFailException('User not exists');
        }

        $userSession = $this->userSessionRepository->getByUser($user);

        if (!$userSession) {
            $userToken = $this->userTokenFactory->create($user);

            /** @var UserSession $userSession */
            $userSession = $this->userSessionFactory->create();

            $userSession->setUser($user);
            $userSession->setToken($userToken);

            $this->userSessionRepository->save($userSession);
        }

        return $userSession;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isLogged(User $user):bool
    {
        $userSession = $this->userSessionRepository->getByUser($user);

        return $userSession !== null;
    }

    /**
     * @param UserSession $userSession
     */
    public function logout(UserSession $userSession)
    {
        $this->userSessionRepository->delete($userSession);
    }
}