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
        $userRepository = $this->mockUserRepository();
        $user           = $this->mockUser(1);
        $manager        = new UserManagerDefault($userRepository);

        $userRepository->shouldReceive('save')->with($user);

        $manager->signup($user);
    }

    /**
     * @test
     */
    public function shouldCreate()
    {
        $userRepository = $this->mockUserRepository();
        $manager        = new UserManagerDefault($userRepository);

        $userRepository->shouldReceive('create');

        $manager->create();
    }

    /**
     * @test
     */
    public function shouldEnable()
    {
        $userRepository = $this->mockUserRepository();
        $user           = $this->mockUser(1);
        $manager        = new UserManagerDefault($userRepository);

        $userRepository->shouldReceive('save')->with($user);
        $user->shouldReceive('enable')->once()->withNoArgs();

        $manager->enable($user);
    }

    /**
     * @test
     */
    public function shouldDisable()
    {
        $userRepository = $this->mockUserRepository();
        $user           = $this->mockUser(1);
        $manager        = new UserManagerDefault($userRepository);

        $userRepository->shouldReceive('save')->once()->with($user);
        $user->shouldReceive('disable')->once()->withNoArgs();

        $manager->disable($user);
    }

    /**
     * @test
     */
    public function shouldExists() {
        $userRepository = $this->mockUserRepository();
        $user           = $this->mockUser(1);
        $manager        = new UserManagerDefault($userRepository);

        $userRepository->shouldReceive('exists')->once()->with($user);

        $manager->exists($user);
    }

    /**
     * @return UserRepository | Mockery\MockInterface
     */
    private function mockUserRepository():UserRepository
    {
        return Mockery::mock(UserRepository::class);
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
