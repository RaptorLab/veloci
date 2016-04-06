<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 06/04/16
 * Time: 00:36
 */

namespace Core\Repository;


use bar\foo\baz\Object;
use Veloci\Core\Helper\Metadata\ModelAnalyzer;
use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\KeyValueStore;
use Veloci\Core\Repository\MetadataRepositoryDefault;
use Veloci\User\User;

class MetadataRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetMetadata1()
    {
        $model = User::class;

        $objectMetadata = $this->mockObjectMetadata();

        $store = $this->mockKeyValueStore();

        $store
            ->shouldReceive('contains')
            ->once()
            ->with($model)
            ->andReturnTrue();

        $store
            ->shouldReceive('get')
            ->once()
            ->with($model)
            ->andReturn($objectMetadata);

        $analyzer = $this->mockModelAnalyzer();

        $metadataRepository = new MetadataRepositoryDefault($store, $analyzer);

        $data = $metadataRepository->getMetadata($model);

        \PHPUnit_Framework_Assert::assertEquals($objectMetadata, $data);
    }

    /**
     * @test
     */
    public function shouldGetMetadata2()
    {
        $model = User::class;

        $objectMetadata = $this->mockObjectMetadata();

        $store = $this->mockKeyValueStore();

        $store
            ->shouldReceive('contains')
            ->once()
            ->with($model)
            ->andReturnFalse();

        $store
            ->shouldReceive('set')
            ->once()
            ->with($model, $objectMetadata);

        $analyzer = $this->mockModelAnalyzer();

        $analyzer
            ->shouldReceive('analyze')
            ->once()
            ->with($model)
            ->andReturn($objectMetadata);

        $metadataRepository = new MetadataRepositoryDefault($store, $analyzer);

        $data = $metadataRepository->getMetadata($model);

        \PHPUnit_Framework_Assert::assertEquals($objectMetadata, $data);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid class. Accepted only MetadataAware instances
     */
    public function shouldRaiseException () {
        $model = \stdClass::class;

        $store = $this->mockKeyValueStore();
        $analyzer = $this->mockModelAnalyzer();

        $metadataRepository = new MetadataRepositoryDefault($store, $analyzer);

        $metadataRepository->getMetadata($model);
    }

    /**
     * @return \Mockery\MockInterface | KeyValueStore
     */
    private function mockKeyValueStore():KeyValueStore
    {
        return \Mockery::mock(KeyValueStore::class);
    }

    /**
     * @return \Mockery\MockInterface | ModelAnalyzer
     */
    private function mockModelAnalyzer():ModelAnalyzer
    {
        return \Mockery::mock(ModelAnalyzer::class);
    }

    private function mockObjectMetadata()
    {
        return \Mockery::mock(ObjectMetadata::class);
    }
}