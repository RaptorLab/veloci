<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 06/03/16
 * Time: 16:22
 */

namespace Veloci\User\Factory;

use Carbon\Carbon;
use Veloci\Core\Factory\ContainerAwareModelFactory;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Helper\Serializer\ModelHydrator;

use Veloci\Core\Model\Model;
use Veloci\User\User;

class UserFactoryDefault extends ContainerAwareModelFactory implements UserFactory
{
    /**
     * UserFactoryDefault constructor.
     * @param DependencyInjectionContainer $container
     * @param ModelHydrator $hydrator
     */
    public function __construct(DependencyInjectionContainer $container, ModelHydrator $hydrator)
    {
        parent::__construct($container, $hydrator, User::class);
    }

    protected function preCreate(array &$data) {
//        $now = (new Carbon())->toDateTimeString();
//
//
//        $this->fillData('updatedAt', $data, $now);
//        $this->fillData('createdAt', $data, $now);
//
//        var_dump($data);
//        die();
    }

    protected function postCreate(Model &$model)
    {

    }

    private function fillData(string $key, array &$data, $value) {
        if(!array_key_exists($key, $data) || $data[$key] === null) {
            $data[$key] = $value;
        }
    }
}