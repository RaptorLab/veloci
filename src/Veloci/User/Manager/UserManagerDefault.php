<?php

namespace Veloci\User\Manager;

use Veloci\Core\Helper\Metadata\ModelValidator;

use Veloci\User\Exception\ValidationException;
use Veloci\User\Repository\UserRepository;
use Veloci\User\User;

class UserManagerDefault implements UserManager
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ModelValidator
     */
    private $modelValidator;

    /**
     *
     * @param UserRepository $userRepository
     * @param ModelValidator $modelValidator
     */
    public function __construct(UserRepository $userRepository, ModelValidator $modelValidator)
    {
        $this->userRepository = $userRepository;
        $this->modelValidator = $modelValidator;
    }

    /**
     *
     * @param User $user
     * @throws \Veloci\User\Exception\ValidationException
     */
    public function signup(User $user)
    {
        if ($this->userRepository->usernameAlreadyExists($user->getUsername())) {
            throw new ValidationException([
                'username' => 'duplicated'
            ]);
        }

        $this->modelValidator->validate($user);

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
    public function exists(User $user):bool
    {
        return $this->userRepository->exists($user);
    }
}
