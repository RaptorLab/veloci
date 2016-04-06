<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 02:19
 */

namespace Veloci\User\Factory;



use Veloci\Core\Factory\ContainerAwareModelFactory;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Helper\Serializer\ModelSerializer;
use Veloci\User\UserSession;

class UserSessionFactoryDefault extends ContainerAwareModelFactory implements UserSessionFactory
{
    /**
     * UserFactoryDefault constructor.
     * @param DependencyInjectionContainer $container
     * @param ModelSerializer $serializer
     */
    public function __construct(DependencyInjectionContainer $container, ModelSerializer $serializer)
    {
        parent::__construct($container, $serializer, UserSession::class);
    }
}