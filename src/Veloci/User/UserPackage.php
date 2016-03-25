<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 17/03/16
 * Time: 16:42
 */

namespace Veloci\User;


use DateTime;
use Veloci\Core\Helper\Metadata\ModelValidator;
use Veloci\Core\Helper\Metadata\ModelValidatorDefault;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\Core\Helper\Serializer\ModelSerializerDefault;
use Veloci\Core\Helper\Serializer\SerializationStrategyRepository;
use Veloci\Core\Helper\Serializer\SerializationStrategyRepositoryDefault;
use Veloci\Core\Helper\Serializer\Strategy\DateTimeStrategy;
use Veloci\Core\Helper\Serializer\Strategy\DoNothingStrategy;
use Veloci\Core\Package\Package;
use Veloci\Core\Repository\InMemoryKeyValueStore;
use Veloci\Core\Repository\MetadataRepository;
use Veloci\Core\Repository\MetadataRepositoryDefault;
use Veloci\Core\Repository\MongoDbManager;
use Veloci\Core\Repository\MongoDbManagerDefault;
use Veloci\Core\Repository\RepositoryType;
use Veloci\User\Factory\UserFactory;
use Veloci\User\Factory\UserFactoryDefault;
use Veloci\User\Factory\UserSessionFactory;
use Veloci\User\Factory\UserSessionFactoryDefault;
use Veloci\User\Factory\UserTokenFactory;
use Veloci\User\Factory\UserTokenFactoryDefault;
use Veloci\User\Manager\AuthManager;
use Veloci\User\Manager\AuthManagerDefault;
use Veloci\User\Manager\UserManager;
use Veloci\User\Manager\UserManagerDefault;
use Veloci\User\Model\UserDefault;
use Veloci\User\Model\UserRoleDefault;
use Veloci\User\Model\UserSessionDefault;
use Veloci\User\Model\UserTokenDefault;
use Veloci\User\Repository\InMemoryUserRepository;
use Veloci\User\Repository\InMemoryUserSessionRepository;
use Veloci\User\Repository\MongoDbUserRepository;
use Veloci\User\Repository\UserRepository;
use Veloci\User\Repository\UserSessionRepository;

class UserPackage extends Package
{

    /**
     *
     */
    protected function init()
    {
        // Models
        $this->container->registerClass(User::class, UserDefault::class);
        $this->container->registerClass(UserRole::class, UserRoleDefault::class);
        $this->container->registerClass(UserSession::class, UserSessionDefault::class);
        $this->container->registerClass(UserToken::class, UserTokenDefault::class);

        // Factories
        $this->container->registerClass(UserFactory::class, UserFactoryDefault::class);
        $this->container->registerClass(UserSessionFactory::class, UserSessionFactoryDefault::class);
        $this->container->registerClass(UserTokenFactory::class, UserTokenFactoryDefault::class);

        // Managers
        $this->container->registerClass(UserManager::class, UserManagerDefault::class);
        $this->container->registerClass(AuthManager::class, AuthManagerDefault::class);

        $this->container->registerClass(MongoDbManager::class, MongoDbManagerDefault::class);
        $this->container->registerClass(ModelSerializer::class, ModelSerializerDefault::class);
        $this->container->registerClass(SerializationStrategyRepository::class, function () {
            $strategyRepository = new SerializationStrategyRepositoryDefault();

            $strategyRepository->setFallback(new DoNothingStrategy());

            $strategyRepository->register(DateTime::class, new DateTimeStrategy('H:i:s d/m/Y'));

            return $strategyRepository;
        });

        $this->container->registerClass(MetadataRepository::class, function () {
            return new MetadataRepositoryDefault(new InMemoryKeyValueStore());
        });

        $this->container->registerClass(ModelValidator::class, ModelValidatorDefault::class);

        // Repositories
        $this->registerRepository(RepositoryType::IN_MEMORY, UserRepository::class, InMemoryUserRepository::class);
        $this->registerRepository(RepositoryType::IN_MEMORY, UserSessionRepository::class, InMemoryUserSessionRepository::class);

        $this->registerRepository(RepositoryType::MONGODB, UserRepository::class, MongoDbUserRepository::class);
    }
}