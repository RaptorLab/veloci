<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 26/03/16
 * Time: 02:53
 */

namespace Veloci\User\Factory;

use InvalidArgumentException;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Repository\KeyValueStore;
use Veloci\User\Resolver\UserResolver;

class UserResolverFactoryDefault implements UserResolverFactory
{
    /**
     * @var KeyValueStore
     */
    private $store;
    /**
     * @var DependencyInjectionContainer
     */
    private $container;

    public function __construct(KeyValueStore $store, DependencyInjectionContainer $container)
    {
        $this->store     = $store;
        $this->container = $container;
    }

    /**
     * @param string $type
     * @return UserResolver
     * @throws InvalidArgumentException
     */
    public function getUserResolver(string $type):UserResolver
    {
        if (!$this->store->contains($type)) {
            throw new InvalidArgumentException("The user resolver $type is not registered");
        }

        $class = $this->store->get($type);

        return $this->container->get($class);
    }

    /**
     * @param string $userResolver
     * @throws InvalidArgumentException
     */
    public function registerUserResolver(string $userResolver)
    {
        if (!is_a($userResolver, UserResolver::class, true)) {
            throw new InvalidArgumentException('Invalid user resolver given');
        }
        $this->store->set($userResolver::getType(), $userResolver);
    }
}