<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 24/03/16
 * Time: 11:23
 */

namespace Veloci\User\Model;


class UserRoleDefaultTest extends \PHPUnit_Framework_TestCase
{
    public function test () {
        $roleName = 'test';

        $role = new UserRoleDefault($roleName);

        \PHPUnit_Framework_Assert::assertEquals($roleName, $role->getName());
    }
}
