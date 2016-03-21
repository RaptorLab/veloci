<?php

namespace Veloci\User\Manager;

use Veloci\User\Repository\UserRepository;
use Veloci\User\User;

class UserManagerDefault implements UserManager
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     *
     * @param User $user
     */
    public function signup(User $user)
    {
        $this->userRepository->save($user);
    }

    /**
     * @param User $user
     */
    public function enable(User $user)
    {
        $user->enable();

        $this->userRepository->save($user);
    }

    /**
     * @param User $user
     */
    public function disable(User $user)
    {
        $user->disable();

        $this->userRepository->save($user);
    }

    /**
     * @param User $user
     * @return boolean
     */
    public function exists(User $user)
    {
        return $this->userRepository->exists($user);
    }

    /**
     * @return User
     */
    public function create()
    {
        return $this->userRepository->create();
    }
}
