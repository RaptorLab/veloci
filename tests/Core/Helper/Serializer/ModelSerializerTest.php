<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 11/03/16
 * Time: 00:18
 */

namespace Veloci\Core\Helper\Serializer;


use DateTime;
use Veloci\Core\Helper\Serializer\ModelSerializerDefault;
use Veloci\Core\Helper\Serializer\SerializationStrategyRepositoryDefault;
use Veloci\Core\Helper\Serializer\Strategy\DateTimeStrategy;
use Veloci\Core\Helper\Serializer\Strategy\DoNothingStrategy;
use Veloci\Core\Repository\InMemoryKeyValueStore;
use Veloci\Core\Repository\MetadataRepositoryDefault;
use Veloci\User\Model\UserDefault;

class ModelSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSerialize()
    {
        $dateTimeFormat = 'H:i:s d/m/Y';

        $user = new UserDefault();

        $strategies = new SerializationStrategyRepositoryDefault();

        $strategies->setFallback(new DoNothingStrategy());

        $strategies->register(DateTime::class, new DateTimeStrategy($dateTimeFormat));

        $metadataRepository = new MetadataRepositoryDefault(new InMemoryKeyValueStore());

        $serializer = new ModelSerializerDefault($strategies, $metadataRepository);

        $data = $serializer->serialize($user);

        $expectedData = [
            'id'        => $user->getId(),
            'enabled'   => $user->isEnabled(),
            'role'      => $user->getRole(),
            'createdAt' => $user->getCreatedAt()->format($dateTimeFormat),
            'updatedAt' => $user->getUpdatedAt()->format($dateTimeFormat),
            'deletedAt' => $user->getDeletedAt()
        ];

        \PHPUnit_Framework_Assert::assertEquals($expectedData, $data);

//        $data['createdAt'] = null;
//
//        $object = $serializer->hydrate($data, new UserDefault(), true);
    }

    private function getSerializationStrategyRepository()
    {
        return null;
    }

    private function getMetadataRepository()
    {
        return null;
    }
}
