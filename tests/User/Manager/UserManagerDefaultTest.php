<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/02/16
 * Time: 01:34
 */

namespace Test\Veloci\User\Manager;


use Mockery;
use Veloci\User\Factory\UserFactory;
use Veloci\User\Manager\UserManagerDefault;
use Veloci\User\Repository\InMemoryUserRepository;
use Veloci\User\Repository\UserRepository;
use Veloci\User\User;

class UserManagerDefaultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSignup()
    {
//        \PHPUnit_Framework_Assert::markTestSkipped('To implements');
        $userRepository = $this->mockUserRepository();
        $user           = $userRepository->create();

        $manager = new UserManagerDefault(
            $userRepository
        );

        $manager->signup($user);

        static::assertTrue($userRepository->exists($user));

        static::assertEquals($user, $userRepository->get($user->getId()));
    }

    /**
     * @return Mockery\MockInterface
     */
    private function mockUserSessionManager()
    {
    }

    /**
     * @return UserRepository
     */
    private function mockUserRepository():UserRepository
    {
//        $mock = Mockery::mock(UserRepository::class);
//
//        return $mock;

        $userFactory = $this->mockUserFactory();

        return new InMemoryUserRepository($userFactory);
    }

    /**
     * @return Mockery\MockInterface|UserFactory
     */
    private function mockUserFactory():UserFactory
    {
        $mock = Mockery::mock(UserFactory::class);

        $mock->shouldReceive('create')
            ->andReturn(
                $this->mockUser(uniqid('user_', true))
            );

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|User
     */
    private function mockUser($id):User
    {
        $mock = Mockery::mock(User::class);

        $mock->shouldReceive('getId')->andReturn($id);

        return $mock;
    }
}
