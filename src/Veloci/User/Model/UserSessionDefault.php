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
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

class UserSessionDefault implements UserSession
{
    use DateableModel;

    private $id;

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
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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

    public function getId()
    {
        return $this->id;
    }
}