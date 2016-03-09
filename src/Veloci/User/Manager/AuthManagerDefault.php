<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 03:17
 */

namespace Veloci\User\Manager;


use Veloci\User\Exception\AuthenticationFail;
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
     * AuthManagerDefault constructor.
     * @param UserSessionRepository $userSessionRepository
     * @param UserRepository $userRepository
     * @param UserTokenFactory $userTokenFactory
     */
    public function __construct(UserSessionRepository $userSessionRepository, UserRepository $userRepository, UserTokenFactory $userTokenFactory)
    {
        $this->userSessionRepository = $userSessionRepository;
        $this->userRepository        = $userRepository;
        $this->userTokenFactory      = $userTokenFactory;
    }

    /**
     * @param User $user
     *
     * @return UserSession
     *
     * @throws AuthenticationFail
     */
    public function login(User $user)
    {
        if (!$this->userRepository->exists($user)) {
            throw new AuthenticationFail('User not exists');
        }

        $userSession = $this->userSessionRepository->getByUser($user);

        if (!$userSession) {
            $userToken   = $this->userTokenFactory->create($user);
            $userSession = $this->userSessionRepository->create($user, $userToken);
            
            $this->userSessionRepository->save($userSession);
        }

        return $userSession;
    }

    public function isLogged(User $user)
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