<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 12:47
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\MetadataRepository;

class ModelSerializerDefault implements ModelSerializer
{
    /** @var  SerializationStrategyRepository */
    private $strategies;
    /**
     * @var MetadataRepository
     */
    private $metadataRepository;

    public function __construct(SerializationStrategyRepository $strategies, MetadataRepository $metadataRepository)
    {
        $this->strategies         = $strategies;
        $this->metadataRepository = $metadataRepository;
    }

    public function serialize(EntityModel $model):array
    {
        $objectMetadata = $this->metadataRepository->getMetadata($model);
        $properties     = $objectMetadata->getProperties();
        $result         = [];

        foreach ($properties as $property) {
            $name   = $property->getName();
            $getter = $property->getGetter();
            $type   = $property->getType();
            $value  = $model->{$getter}();

            $result[$name] = $this->serializeProperty($type, $value);
        }

        return $result;
    }

    private function serializeProperty($type, $value)
    {
        $strategy = $this->strategies->get($type);

        if (!$strategy) {
            throw new \RuntimeException("No strategy registered for the type $type");
        }

        return $strategy->serialize($value);
    }
}