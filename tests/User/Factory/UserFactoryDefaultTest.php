<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 21/03/16
 * Time: 15:03
 */

namespace User\Factory;


use Mockery;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\User\Factory\UserFactoryDefault;
use Veloci\User\User;

class UserFactoryDefaultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldCreateAnUser()
    {
        $container  = $this->mockDependencyInjectionContainer();
        $serializer = $this->mockSerializer();

        $factory = new UserFactoryDefault($container, $serializer);

        $user = $factory->create();

        \PHPUnit_Framework_Assert::assertInstanceOf(User::class, $user);
    }


    /**
     * @return DependencyInjectionContainer | Mockery\MockInterface
     */
    private function mockDependencyInjectionContainer():DependencyInjectionContainer
    {
        $mock = Mockery::mock(DependencyInjectionContainer::class);

        $mock->shouldReceive('get')->with(User::class)->andReturn($this->mockUser());

        return $mock;
    }

    /**
     * @return Mockery\MockInterface | ModelSerializer
     */
    private function mockSerializer():ModelSerializer
    {
        $mock = Mockery::mock(ModelSerializer::class);

        $mock->shouldReceive('hydrate');

        return $mock;
    }

    /**
     * @return Mockery\MockInterface | User
     */
    private function mockUser():User
    {
        return Mockery::mock(User::class);
    }
}
