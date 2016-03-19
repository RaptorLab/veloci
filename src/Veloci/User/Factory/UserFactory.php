<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:16
 */

namespace Veloci\User\Factory;

use Veloci\Core\Factory\ModelFactory;
use Veloci\Core\Model\EntityModel;
use Veloci\User\User;

interface UserFactory extends ModelFactory
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data = []):EntityModel;
}