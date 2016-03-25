<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 24/03/16
 * Time: 21:43
 */

namespace Veloci\Core\Helper\Metadata;

use Veloci\Core\Model\EntityModel;
use Veloci\Core\Repository\MetadataRepository;
use Veloci\User\Exception\ValidationException;

class ModelValidatorDefault implements ModelValidator
{
    /**
     * @var MetadataRepository
     */
    private $metadataRepository;

    public function __construct(MetadataRepository $metadataRepository)
    {
        $this->metadataRepository = $metadataRepository;
    }

    /**
     * @param EntityModel $model
     * @throws ValidationException
     */
    public function validate(EntityModel $model)
    {
        $metadata = $this->metadataRepository->getMetadata($model);

        $properties = $metadata->getProperties();

        foreach ($properties as $property) {
            $this->nullableValidator($metadata, $property, $model);
        }
    }

    /**
     * @param ObjectMetadata $object
     * @param PropertyMetadata $property
     * @param EntityModel $model
     * @throws ValidationException
     */
    private function nullableValidator(ObjectMetadata $object, PropertyMetadata $property, EntityModel $model)
    {
        if (!$property->isNullable()) {
            $value = $object->getValue($model, $property->getName());

            if ($value === null) {
                throw new ValidationException($property->getName() . ' is required');
            }
        }
    }
}