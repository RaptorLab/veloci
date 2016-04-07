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
use Veloci\Core\Helper\Serializer\ModelHydrator;

use Veloci\User\UserSession;

class UserSessionFactoryDefault extends ContainerAwareModelFactory implements UserSessionFactory
{
    /**
     * UserFactoryDefault constructor.
     * @param DependencyInjectionContainer $container
     * @param ModelHydrator $hydrator
     */
    public function __construct(DependencyInjectionContainer $container, ModelHydrator $hydrator)
    {
        parent::__construct($container, $hydrator, UserSession::class);
    }
}