<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 21/02/16
 * Time: 19:54
 */

namespace Veloci\User\Model;


use DateTime;

use Veloci\Core\Model\DateableModel;
use Veloci\Core\Model\RichEntityModel;
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

class UserSessionDefault extends RichEntityModel implements UserSession
{
    /**
     * @var mixed
     */
    private $userId;

    /**
     * SessionTokenModelDefault constructor.
     *
     * @param UserToken $userToken
     * @param User $user
     */
    public function __construct(UserToken $userToken, User $user)
    {
        $this->id        = (string)$userToken;
        $this->userId    = $user->getId();
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    public function __wakeup()
    {
        $this->updatedAt = new DateTime();
    }
}