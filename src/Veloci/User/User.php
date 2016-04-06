<?php

namespace Veloci\User;

use Veloci\Core\Model\EntityModel;

/**
 * Description of UserModel
 *
 * @author christian
 */
interface User extends EntityModel {
    public function getUsername():string;

    public function getPassword():string;

    public function isEnabled();

    public function enable();

    public function disable();
}
