<?php

namespace Veloci\User;

use DateTime;
use Veloci\Core\Model\EntityModel;

interface UserSession extends EntityModel {

    /**
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * @return DateTime
     */
    public function getUpdatedAt();


    /**
     * @return mixed
     */
    public function getUserId();
}
