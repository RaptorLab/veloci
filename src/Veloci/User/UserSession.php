<?php

namespace Veloci\User;

use DateTime;
use Veloci\Core\Model\EntityModel;

interface UserSession extends EntityModel {

    /**
     * @return DateTime
     */
    public function getCreatedAt():DateTime;

    /**
     * @return DateTime
     */
    public function getUpdatedAt():DateTime;


    /**
     * @return mixed
     */
    public function getUserId();
}
