<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:32
 */

namespace Veloci\Core\Repository;

use Veloci\Core\Helper\ClassHelper;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Core\Helper\Metadata\ModelAnalyzer;
use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\Core\Model\MetadataAware;

class MetadataRepositoryDefault implements MetadataRepository
{
    /**
     * @var KeyValueStore
     */
    private $storage;
    /**
     * @var ModelAnalyzer
     */
    private $modelAnalyzer;
    /**
     * @var DependencyInjectionContainer
     */
    private $container;

    /**
     * MetadataRepositoryDefault constructor.
     *
     * @param KeyValueStore $storage
     * @param ModelAnalyzer $modelAnalyzer
     * @param DependencyInjectionContainer $container
     */
    public function __construct(KeyValueStore $storage, ModelAnalyzer $modelAnalyzer, DependencyInjectionContainer $container)
    {
        $this->storage       = $storage;
        $this->modelAnalyzer = $modelAnalyzer;
        $this->container     = $container;
    }


    public function getMetadata($class):ObjectMetadata
    {
        if (!is_a($class, MetadataAware::class, true)) {
            throw new \InvalidArgumentException('Invalid class. Accepted only MetadataAware instances');
        }

        /** @var MetadataAware|string $className */
        $className = ClassHelper::getClassName($class);

        // Resolving the container interface
        if ($this->container->contains($className)) {
            $className = $this->container->getClass($className);
        }

        if ($this->storage->contains($className)) {
            $metadata = $this->storage->get($className);
        } else {
            $metadata = $this->modelAnalyzer->analyze($className);

            $this->storage->set($className, $metadata);
        }

        return $metadata;
    }
}