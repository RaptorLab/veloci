<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 12:47
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Helper\Serializer\SerializationStrategyRepository;
use Veloci\Core\Model\RichEntityModel;
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

    public function serialize(RichEntityModel $model):array
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

    public function hydrate(array $data, RichEntityModel $target, $fullHydration = false):RichEntityModel
    {
        $objectMetadata = $this->metadataRepository->getMetadata($target);
        $properties     = $objectMetadata->getProperties();

        foreach ($properties as $property) {
            if ($fullHydration || !$property->isReadOnly()) {
                $name  = $property->getName();
                $type  = $property->getType();
                $value = array_key_exists($name, $data) ? $data[$name] : null;

                $hydratedValue = $this->hydrateProperty($type, $value);

                $objectMetadata->setValue($target, $name, $hydratedValue);
            }
        }

        return $target;
    }

    private function serializeProperty($type, $value)
    {
        $strategy = $this->strategies->get($type);

        if (!$strategy) {
            throw new \RuntimeException("No strategy registered for the type $type");
        }

        return $strategy->serialize($value);
    }

    private function hydrateProperty($type, $value)
    {
        $strategy = $this->strategies->get($type);

        if (!$strategy) {
            throw new \RuntimeException("No strategy registered for the type $type");
        }

        return $strategy->deserialize($value);
    }
}