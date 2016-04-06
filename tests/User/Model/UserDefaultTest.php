<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 23/03/16
 * Time: 15:39
 */

namespace User\Model;


use bar\foo\baz\Object;
use DateTime;
use Mockery;
use Mockery\MockInterface;
use PHPUnit_Framework_Assert as PHPUnit;
use Veloci\Core\Helper\Metadata\Domain\StringDomain;
use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\Core\Helper\Metadata\PropertyMetadata;
use Veloci\User\Model\UserDefault;
use Veloci\User\Model\UserRoleDefault;

class UserDefaultTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterAndGetter()
    {
        $user = new UserDefault();

        PHPUnit::assertInstanceOf(DateTime::class, $user->getCreatedAt());
        PHPUnit::assertInstanceOf(DateTime::class, $user->getUpdatedAt());
        PHPUnit::assertNull($user->getDeletedAt());
        PHPUnit::assertSame('user', $user->getRole()->getName());

        $role = new UserRoleDefault('test');
        $user->setRole($role);

        PHPUnit::assertSame($role, $user->getRole());

        PHPUnit::assertFalse($user->isEnabled());
        $user->enable();
        PHPUnit::assertTrue($user->isEnabled());
        $user->disable();
        PHPUnit::assertFalse($user->isEnabled());
    }

    public function testMetadata()
    {
//        $user = new UserDefault();
//
//        $objectMetadata = $this->mockObjectMetadata();
//
//        $this->checkObjectProperty($objectMetadata, 'id', 'setPrimaryKey', true);
//        $this->checkObjectProperty($objectMetadata, 'createdAt', 'setReadOnly', true);
//        $this->checkObjectProperty($objectMetadata, 'updatedAt', 'setReadOnly', true);
//        $this->checkObjectProperty($objectMetadata, 'username', 'setDomain', Mockery::on(function ($arg) {
//            var_dump($arg);
//            die();
//        }));
//
//        $user::setCustomMetadata($objectMetadata);
    }

    private function checkObjectProperty(MockInterface $object, string $property, string $setter, $value)
    {
        $propertyMetadata = $this->mockPropertyMetadata();

        $this->checkPropertySetter($propertyMetadata, $setter, $value);

        $object
            ->shouldReceive('getProperty')
            ->with($property)
            ->andReturn(
                $propertyMetadata
            );

        return $propertyMetadata;
    }

    /**
     * @param PropertyMetadata| MockInterface $property
     * @param string $setter
     * @param mixed $value
     * @return PropertyMetadata
     */
    private function checkPropertySetter(MockInterface $property, string $setter, $value)
    {
        $property
            ->shouldReceive($setter)
            ->with($value)
            ->andReturn($property);

        return $property;
    }

    /**
     * @return ObjectMetadata|MockInterface
     */
    private function mockObjectMetadata():ObjectMetadata
    {
        $object = Mockery::mock(ObjectMetadata::class);

        $property = $this->mockPropertyMetadata();
        $property->shouldReceive('setPrimaryKey')->with(true)->andReturn($property);

        $object
            ->shouldReceive('getProperty')
            ->with('id')
            ->andReturn($property);

        $object
            ->shouldReceive('getProperty')
            ->with('createdAt')
            ->andReturn(
                $this->mockPropertyMetadata()
                    ->shouldReceive('setReadOnly')
                    ->with(true)
            );


        $object
            ->shouldReceive('getProperty')
            ->with('updatedAt')
            ->andReturn(
                $this->mockPropertyMetadata()
                    ->shouldReceive('setReadOnly')
                    ->with(true)
            );

        $property = $this->mockPropertyMetadata();

        $property
            ->shouldReceive('setDomain')
            ->andReturn($property);

        $property
            ->shouldReceive('setNullable')
            ->with(false);

        $object
            ->shouldReceive('getProperty')
            ->with('username')
            ->andReturn($property);

        return $object;
    }

    /**
     * @return MockInterface|PropertyMetadata
     */
    private function mockPropertyMetadata():PropertyMetadata
    {
        $mock = Mockery::mock(PropertyMetadata::class);

        return $mock;
    }
}
