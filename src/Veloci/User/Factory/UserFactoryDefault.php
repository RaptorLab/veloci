<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 06/03/16
 * Time: 16:22
 */

namespace Veloci\User\Factory;

use Veloci\Core\Factory\ContainerAwareModelFactory;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\User\User;

class UserFactoryDefault extends ContainerAwareModelFactory implements UserFactory
{
    /**
     * UserFactoryDefault constructor.
     * @param DependencyInjectionContainer $container
     * @param ModelSerializer $serializer
     */
    public function __construct(DependencyInjectionContainer $container, ModelSerializer $serializer)
    {
        parent::__construct($container, $serializer, User::class);
    }

}