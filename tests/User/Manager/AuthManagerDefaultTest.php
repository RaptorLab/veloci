<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 22/03/16
 * Time: 20:54
 */

namespace User\Manager;


use Mockery;
use PHPUnit_Framework_Assert;
use Veloci\User\Factory\UserTokenFactory;
use Veloci\User\Manager\AuthManager;
use Veloci\User\Manager\AuthManagerDefault;
use Veloci\User\Repository\UserRepository;
use Veloci\User\Repository\UserSessionRepository;
use Veloci\User\User;
use Veloci\User\UserSession;
use Veloci\User\UserToken;

class AuthManagerDefaultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AuthManager
     */
    private $manager;

    /**
     * @var UserSessionRepository | Mockery\MockInterface
     */
    private $userSessionRepository;

    /**
     * @var UserRepository | Mockery\MockInterface
     */
    private $userRepository;

    /**
     * @var UserTokenFactory | Mockery\MockInterface
     */
    private $userTokenFactory;

    public function setUp()
    {
        parent::setUp();

        $this->userSessionRepository = $this->mockUserSessionRepository();
        $this->userRepository        = $this->mockUserRepository();
        $this->userTokenFactory      = $this->mockUserTokenFactory();

        $this->manager = new AuthManagerDefault(
            $this->userSessionRepository,
            $this->userRepository,
            $this->userTokenFactory
        );
    }

    /**
     * @test
     */
    public function shouldLogin()
    {
        $userSession = $this->mockUserSession();
        $userToken   = $this->mockUserToken();
        $user        = $this->mockUser();

        $this->userRepository
            ->shouldReceive('exists')
            ->once()
            ->with($user)
            ->andReturn(true);

        $this->userSessionRepository
            ->shouldReceive('getByUser')
            ->once()
            ->with($user)
            ->andReturn(null);

        $this->userSessionRepository
            ->shouldReceive('create')
            ->once()
            ->with($user, $userToken)
            ->andReturn($userSession);

        $this->userSessionRepository
            ->shouldReceive('save')
            ->once()
            ->with($userSession);

        $this->userTokenFactory
            ->shouldReceive('create')
            ->once()
            ->with($user)
            ->andReturn($userToken);

        $result = $this->manager->login($user);

        PHPUnit_Framework_Assert::assertEquals($userSession, $result);
    }

    /**
     * @test
     */
    public function shouldReLogin()
    {
        $userSession = $this->mockUserSession();
        $user        = $this->mockUser();

        $this->userRepository
            ->shouldReceive('exists')
            ->once()
            ->with($user)
            ->andReturn(true);

        $this->userSessionRepository
            ->shouldReceive('getByUser')
            ->once()
            ->with($user)
            ->andReturn($userSession);

        $this->userSessionRepository
            ->shouldReceive('create')
            ->never();

        $this->userSessionRepository
            ->shouldReceive('save')
            ->never();

        $this->userTokenFactory
            ->shouldReceive('create')
            ->never();

        $result = $this->manager->login($user);

        PHPUnit_Framework_Assert::assertEquals($userSession, $result);
    }

    /**
     * @test
     * @expectedException \Veloci\User\Exception\AuthenticationFailException
     */
    public function shouldNotLogin()
    {
        $userSession = $this->mockUserSession();
        $user        = $this->mockUser();

        $this->userRepository
            ->shouldReceive('exists')
            ->once()
            ->with($user)
            ->andReturn(false);

        $result = $this->manager->login($user);

        PHPUnit_Framework_Assert::assertEquals($userSession, $result);
    }

    /**
     * @test
     */
    public function shouldBeLogged()
    {
        $user        = $this->mockUser();
        $userSession = $this->mockUserSession();

        $this->userSessionRepository
            ->shouldReceive('getByUser')
            ->once()
            ->andReturn($userSession);

        $result = $this->manager->isLogged($user);

        PHPUnit_Framework_Assert::assertTrue($result);
    }

    /**
     * @test
     */
    public function shouldNotBeLogged()
    {
        $user        = $this->mockUser();

        $this->userSessionRepository
            ->shouldReceive('getByUser')
            ->once()
            ->andReturn(null);

        $result = $this->manager->isLogged($user);

        PHPUnit_Framework_Assert::assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldLogout()
    {
        $userSession = $this->mockUserSession();

        $this->userSessionRepository
            ->shouldReceive('delete')
            ->once()
            ->with($userSession);

        $this->manager->logout($userSession);
    }

    /**
     * @return Mockery\MockInterface | UserSessionRepository
     */
    private function mockUserSessionRepository():UserSessionRepository
    {
        return Mockery::mock(UserSessionRepository::class);
    }

    /**
     * @return UserRepository | Mockery\MockInterface
     */
    private function mockUserRepository():UserRepository
    {
        return Mockery::mock(UserRepository::class);
    }

    /**
     * @return UserTokenFactory | Mockery\MockInterface
     */
    private function mockUserTokenFactory():UserTokenFactory
    {
        return Mockery::mock(UserTokenFactory::class);
    }

    /**
     * @return User | Mockery\MockInterface
     */
    private function mockUser():User
    {
        return Mockery::mock(User::class);
    }

    /**
     * @return UserSession | Mockery\MockInterface
     */
    private function mockUserSession():UserSession
    {
        return Mockery::mock(UserSession::class);
    }

    /**
     * @return UserToken | Mockery\MockInterface
     */
    private function mockUserToken():UserToken
    {
        return Mockery::mock(UserToken::class);
    }
}
