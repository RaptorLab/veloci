<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/02/16
 * Time: 01:34
 */

namespace Test\Veloci\User\Manager;


use Mockery;
use Veloci\User\Manager\UserManager;
use Veloci\User\Manager\UserManagerDefault;
use Veloci\User\Manager\UserSessionManager;
use Veloci\User\Model\UserModelDefault;
use Veloci\User\Repository\InMemoryUserRepository;
use Veloci\User\Repository\UserRepository;

class UserManagerDefaultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSignup()
    {
        $userSessionManager = $this->mockUserSessionManager();
        $userRepository     = $this->mockUserRepository();

        $manager = new UserManagerDefault(
            $userSessionManager,
            $userRepository
        );

        $user = new UserModelDefault(1);

        static::assertFalse($userRepository->exists($user));

        $manager->signup($user);

        static::assertTrue($userRepository->exists($user));

        static::assertEquals($user, $userRepository->get($user->getId()));
    }

    /**
     * @return Mockery\MockInterface|UserSessionManager
     */
    private function mockUserSessionManager()
    {
        return Mockery::mock(UserSessionManager::class);
    }

    /**
     * @return UserRepository
     */
    private function mockUserRepository()
    {
//        $mock = Mockery::mock(UserRepository::class);
//
//        return $mock;

        return new InMemoryUserRepository();
    }
}
