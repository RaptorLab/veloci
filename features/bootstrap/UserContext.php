<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 21/02/16
 * Time: 11:41
 */
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use PHPUnit_Framework_Assert as PHPUnit;
use Veloci\User\Exception\AuthenticationFail;
use Veloci\User\Factory\UserFactoryDefault;
use Veloci\User\Factory\UserSessionFactoryDefault;
use Veloci\User\Factory\UserTokenFactoryDefault;
use Veloci\User\Manager\AuthManager;
use Veloci\User\Manager\UserManagerDefault;
use Veloci\User\Repository\InMemoryUserRepository;
use Veloci\User\Repository\InMemoryUserSessionRepository;
use Veloci\User\Repository\UserRepository;
use Veloci\User\Repository\UserSessionRepository;
use Veloci\User\User;
use Veloci\User\UserSession;

class UserContext implements Context, SnippetAcceptingContext
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var \Veloci\User\Manager\UserManager
     */
    private $userManager;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserSessionRepository
     */
    private $userSessionRepository;

    /**
     * @var AuthManager
     */
    private $authenticationManager;

    /**
     * @var UserSession
     */
    private $userSession;

    /**
     * @var Exception
     */
    private $lastException;

    /**
     * @BeforeScenario
     */
    public function before()
    {
        $this->userRepository = new InMemoryUserRepository(new UserFactoryDefault());
        $this->userManager    = new UserManagerDefault($this->userRepository);

        $this->userSessionRepository = new InMemoryUserSessionRepository(new UserSessionFactoryDefault());
        $this->authenticationManager = new \Veloci\User\Manager\AuthManagerDefault(
            $this->userSessionRepository,
            $this->userRepository,
            new UserTokenFactoryDefault()
        );
    }

    /**
     * @Given /^I filled all the signup data$/
     */
    public function iFilledAllTheSignupData()
    {
        $this->user = $this->userManager->create();

        $this->user->enable();
    }

    /**
     * @When /^I signup$/
     */
    public function iSignup()
    {
        $this->userManager->signup($this->user);
    }

    /**
     * @Then /^the user must be registered$/
     */
    public function theUserMustBeRegistered()
    {
        PHPUnit::assertTrue($this->userManager->exists($this->user));
    }

    /**
     * @Given /^a registered user$/
     */
    public function aRegisteredUser()
    {
        $this->iFilledAllTheSignupData();
        $this->iSignup();
    }

    /**
     * @When /^I login$/
     */
    public function iLogin()
    {
        try {
            $this->userSession = $this->authenticationManager->login($this->user);
        } catch (Exception $ex) {
            $this->lastException = $ex;
        }
    }

    /**
     * @Given /^a not registered user$/
     */
    public function aNotRegisteredUser()
    {
        $this->user = $this->userManager->create();
    }

    /**
     * @Given /^a user not found error must be raised$/
     */
    public function aUserNotFoundErrorMustBeRaised()
    {
        PHPUnit::assertNotNull($this->lastException);
        PHPUnit::assertInstanceOf(AuthenticationFail::class, $this->lastException);
        PHPUnit::assertEquals('User not exists', $this->lastException->getMessage());
    }

    /**
     * @Given /^I filled wrong signup data$/
     */
    public function iFilledWrongSignupData()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^the user must not be registered$/
     */
    public function theUserMustNotBeRegistered()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Given /^a wrong data error must be raised$/
     */
    public function aWrongDataErrorMustBeRaised()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^the user is logged$/
     */
    public function theUserIsLogged()
    {
        $userSession = $this->userSessionRepository->get($this->userSession->getId());

        PHPUnit::assertEquals($this->userSession, $userSession);
    }

    /**
     * @Then /^the user is not logged$/
     */
    public function theUserIsNotLogged()
    {
        PHPUnit::assertNotNull($this->user);

        $userSession = $this->userSessionRepository->getByUser($this->user);

        PHPUnit::assertNull($userSession);
    }
}