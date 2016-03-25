<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 12:46
 */

namespace Veloci\Core\Helper\Validation;


use Veloci\Core\Helper\ClassHelper;
use Veloci\Core\Helper\Metadata\PropertyMetadata;
use Veloci\Core\Helper\Validation\Rule\IntegerRule;
use Veloci\Core\Helper\Validation\Rule\ValidationRule;
use Veloci\Core\Repository\KeyValueStore;
use Veloci\Core\Repository\MetadataRepository;

class ValidationRuleRepositoryDefault implements ValidationRulesRepository
{
    /**
     * @var MetadataRepository
     */
    private $metadataRepository;
    /**
     * @var KeyValueStore
     */
    private $store;

    public function __construct(MetadataRepository $metadataRepository, KeyValueStore $store)
    {
        $this->metadataRepository = $metadataRepository;
        $this->store              = $store;
    }

    /**
     * @param $model
     * @return ValidationRule[]
     */
    public function getValidationRules($model):array
    {
        $className = ClassHelper::getClassName($model);

        $validationRules = $this->store->get($className);

        if ($validationRules === null) {
            $validationRules = $this->createValidationRules($className);
        }
    }

    /**
     * @param string $className
     * @return ValidationRule[]
     */
    private function createValidationRules(string $className):array
    {
        $validationRules = [];

        $metadata = $this->metadataRepository->getMetadata($className);

        $properties = $metadata->getProperties();

        foreach ($properties as $name => $property) {
            $rules = [];

            $this->addIntegerRule($property, $rules);
        }

        return $validationRules;
    }

    private function addIntegerRule (PropertyMetadata $property, array &$rules) {
        if ($property->getType() === 'int') {
            $rules[] = new IntegerRule();
        }
    }
}