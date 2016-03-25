<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 23/03/16
 * Time: 15:39
 */

namespace User\Model;


use DateTime;
use PHPUnit_Framework_Assert as PHPUnit;
use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\User\Model\UserDefault;
use Veloci\User\Model\UserRoleDefault;

class UserDefaultTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $user = new UserDefault();

        PHPUnit::assertInstanceOf(DateTime::class, $user->getCreatedAt());
        PHPUnit::assertInstanceOf(DateTime::class, $user->getUpdatedAt());
        PHPUnit::assertNull($user->getDeletedAt());
        PHPUnit::assertSame('user', $user->getRole()->getName());

        $role = new UserRoleDefault('test');
        $user->setRole($role);

        PHPUnit::assertSame($role, $user->getRole());

        PHPUnit::assertFalse($user->isEnabled());
        $user->enable();
        PHPUnit::assertTrue($user->isEnabled());
        $user->disable();
        PHPUnit::assertFalse($user->isEnabled());

        $metadata = $user::getCustomMetadata();

        PHPUnit::assertInstanceOf(ObjectMetadata::class, $metadata);
        PHPUnit::assertTrue($metadata->getProperty('createdAt')->isReadOnly());
        PHPUnit::assertTrue($metadata->getProperty('updatedAt')->isReadOnly());
        PHPUnit::assertTrue($metadata->getProperty('deletedAt')->isReadOnly());
        PHPUnit::assertTrue($metadata->getProperty('id')->isReadOnly());
        PHPUnit::assertTrue($metadata->getProperty('id')->isPrimaryKey());
    }
}
