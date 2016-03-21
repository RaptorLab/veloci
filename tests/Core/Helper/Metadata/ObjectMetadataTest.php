<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 21/03/16
 * Time: 16:24
 */

namespace Core\Helper\Metadata;

use PHPUnit_Framework_Assert as PHPUnit;
use Symfony\Component\Yaml\Exception\RuntimeException;
use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\User\Model\UserDefault;

class ObjectMetadataTest extends \PHPUnit_Framework_TestCase
{

    public function test()
    {
        $object = new UserDefault();
        $type   = UserDefault::class;

        $metadata = new ObjectMetadata($object);

        PHPUnit::assertEquals($type, $metadata->getType());

        PHPUnit::assertNotEquals(10, $object->getId());
        $metadata->setValue($object, 'id', 10);
        PHPUnit::assertEquals(10, $object->getId());

        PHPUnit::assertEquals(new \ReflectionClass($object), $metadata->getReflectionClass());

        try {
            $metadata->getProperty('thisPropertyDoesNotExists', true);
            PHPUnit::fail('Must raise an exception');
        } catch(\RuntimeException $ex) {

        }

        $property = $metadata->getProperty('thisPropertyDoesNotExists');

        PHPUnit::assertNull($property);

        $properties = $metadata->getProperties();
        $type       = $metadata->getType();

        $object = unserialize(serialize($metadata));

        PHPUnit::assertEquals($properties, $object->getProperties());
        PHPUnit::assertEquals($type, $object->getType());
        PHPUnit::assertEquals($metadata, $object);
    }
}
