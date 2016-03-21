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
use Veloci\User\Factory\UserSessionFactoryDefault;
use Veloci\User\Model\UserSessionDefault;
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

class UserSessionFactoryDefaultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldCreateAnUser()
    {
        $user      = $this->mockUser();
        $userToken = $this->mockUserToken();

        $factory = new UserSessionFactoryDefault();

        $userSession = $factory->create($user, $userToken);

        \PHPUnit_Framework_Assert::assertInstanceOf(UserSessionDefault::class, $userSession);
    }

    /**
     * @return Mockery\MockInterface | User
     */
    private function mockUser():User
    {
        $mock = Mockery::mock(User::class);

        $mock->shouldReceive('getId')->andReturn(1);

        return $mock;
    }

    /**
     * @return Mockery\MockInterface | UserToken
     */
    private function mockUserToken()
    {
        return Mockery::mock(UserToken::class);
    }
}
