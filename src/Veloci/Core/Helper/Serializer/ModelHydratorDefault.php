<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 06/04/16
 * Time: 14:26
 */

namespace Veloci\Core\Helper\Serializer;


use Veloci\Core\Repository\MetadataRepository;

class ModelHydratorDefault implements ModelHydrator
{
    /**
     * @var MetadataRepository
     */
    private $metadataRepository;
    /**
     * @var SerializationStrategyRepository
     */
    private $strategies;

    public function __construct(MetadataRepository $metadataRepository, SerializationStrategyRepository $strategies)
    {
        $this->metadataRepository = $metadataRepository;
        $this->strategies         = $strategies;
    }

    /**
     * @param string $className
     * @param array $data
     * @param bool $fullHydration
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function hydrate(string $className, array $data, bool $fullHydration = false)
    {
        $objectMetadata = $this->metadataRepository->getMetadata($className);

        $target = $objectMetadata->getReflectionClass()->newInstance();

        foreach ($data as $key => $value) {

            $property = $objectMetadata->getProperty($key);

            if ($property && ($fullHydration || !$property->isReadOnly())) {
                $type = $property->getType();
                $value = array_key_exists($key, $data) ? $data[$key] : null;

                $hydratedValue = $this->hydrateProperty($type, $value);

                $objectMetadata->setValue($target, $key, $hydratedValue);
            }
        }

        return $target;
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