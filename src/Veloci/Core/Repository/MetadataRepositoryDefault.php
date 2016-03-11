<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:32
 */

namespace Veloci\Core\Repository;

use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\Core\Model\MetadataAware;

class MetadataRepositoryDefault implements MetadataRepository
{
    /**
     * @var KeyValueStore
     */
    private $storage;

    /**
     * MetadataRepositoryDefault constructor.
     *
     * @param KeyValueStore $storage
     */
    public function __construct(KeyValueStore $storage)
    {
        $this->storage = $storage;
    }


    public function getMetadata($class):ObjectMetadata
    {
        if (!is_a($class, MetadataAware::class, true)) {
            throw new \RuntimeException('Invalid class. Accepted only MetadataAware instances');
        }

        /** @var MetadataAware|string $className */
        $className = $this->getClassName($class);

        $metadata = $this->storage->get($className);

        if (!$metadata) {
            $metadata = $className::getMetadata();

            $this->storage->set($className, $metadata);
        }

        return $metadata;
    }

    private function getClassName($class)
    {
        return is_string($class) ? $class : get_class($class);
    }
}