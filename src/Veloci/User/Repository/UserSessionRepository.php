<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 01:45
 */

namespace Veloci\User\Repository;


use Veloci\Core\Repository\EntityRepository;
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

interface UserSessionRepository extends EntityRepository
{
    /**
     * @param User $user
     * @param UserToken $userToken
     * @return UserSession
     */
    public function create(User $user, UserToken $userToken);

    /**
     * @param User $user
     * @return UserSession
     */
    public function getByUser(User $user);
}