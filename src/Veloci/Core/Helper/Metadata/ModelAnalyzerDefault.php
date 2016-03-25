<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 01:17
 */

namespace Veloci\Core\Helper\Metadata;

use ReflectionMethod;
use Veloci\Core\Helper\Metadata\Domain\DomainResolver;
use Veloci\Core\Model\EntityModel;

final class ModelAnalyzerDefault implements ModelAnalyzer
{

    /**
     * @var DomainResolver
     */
    private $domainResolver;

    public function __construct(DomainResolver $domainResolver)
    {
        $this->domainResolver = $domainResolver;
    }

    /**
     * @param string $object
     * @return ObjectMetadata
     *
     * @throws  \InvalidArgumentException
     */
    public function analyze(string $object):ObjectMetadata
    {
        if (!is_a($object, EntityModel::class, true)) {
            throw new \InvalidArgumentException('Expected ' . EntityModel::class . ', found ' . $object);
        }

        $objectMetadata = new ObjectMetadata($object);

        $methods = $objectMetadata->getMethods();

        /** @var ReflectionMethod $method */
        foreach ($methods as $method) {
            $propertyName = $this->getPropertyName($method->getName());

            // is a getter
            // is public
            // is not static
            if ($propertyName !== null && $method->isPublic() && !$method->isStatic()) {

                $propertyInfo = $this->analyzeProperty($propertyName, $method, $objectMetadata);
                $objectMetadata->addProperty($propertyInfo);
            }
        }

        /** @var EntityModel $object */
        $object::setCustomMetadata($objectMetadata);

        return $objectMetadata;
    }

    private function analyzeProperty(string $propertyName, ReflectionMethod $method, ObjectMetadata $objectMetadata):PropertyMetadata
    {
        $propertyInfo = new PropertyMetadata();
        $setter       = $this->getSetterName($propertyName);

        $this->setReturnTypeInfo($propertyInfo, $method);

        $propertyInfo->setName($propertyName);
        $propertyInfo->setReadOnly(!$objectMetadata->hasMethod($setter));
        $propertyInfo->setGetter($method->getName());
        $propertyInfo->setSetter($setter);

        return $propertyInfo;
    }

    private function setReturnTypeInfo(PropertyMetadata $propertyInfo, ReflectionMethod $method)
    {
        $returnType = $method->getReturnType();

        $docComment = $method->getDocComment();

        if ($returnType) {
            $propertyInfo->setType((string)$returnType);
            $propertyInfo->setNullable($returnType->allowsNull());
            $propertyInfo->setBuiltIn($returnType->isBuiltin());
        } else {

            $returnType = $this->parseReturnTypeDocBlock($docComment);

            $propertyInfo->setType($returnType);
            $propertyInfo->setNullable(true);
            $propertyInfo->setBuiltIn(false);
        }

        $domainInfo = $this->parseDomainTypeDocBlock($docComment);

        $domain = $this->domainResolver->resolveDomain($propertyInfo->getType(), $domainInfo);

        if ($domain) {
            $propertyInfo->setDomain($domain);
        }

    }

    private function parseReturnTypeDocBlock($docBlock)
    {
        $result = preg_match('/@return ([\w].)/', $docBlock, $matches);

        return ($result === 1)
            ? $matches[1]
            : 'mixed';
    }

    private function parseDomainTypeDocBlock($docBlock)
    {
        $result = preg_match('/@domain (.*)/', $docBlock, $matches);

        return ($result === 1)
            ? $matches[1]
            : null;
    }

    private function getPropertyName(string $methodName)
    {
        if (strpos($methodName, 'get') === 0) {
            $propertyName = substr($methodName, 3);
        } else if (strpos($methodName, 'is') === 0) {
            $propertyName = substr($methodName, 2);
        } else {
            return null;
        }

        $propertyName[0] = strtolower($propertyName[0]);

        return $propertyName;
    }

    private function getSetterName(string $propertyName)
    {
        $propertyName[0] = strtoupper($propertyName[0]);

        return 'set' . $propertyName;
    }
}