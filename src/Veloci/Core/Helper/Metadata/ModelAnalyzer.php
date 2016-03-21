<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 01:17
 */

namespace Veloci\Core\Helper\Metadata;


use ReflectionClass;
use ReflectionMethod;

final class ModelAnalyzer
{
    /**
     * @param $object
     * @return ObjectMetadata
     */
    public static function analyze($object):ObjectMetadata
    {
        $objectMetadata = new ObjectMetadata($object);

        $methods = $objectMetadata->getMethods();

        /** @var ReflectionMethod $method */
        foreach ($methods as $method) {
            $getter       = $method->getName();
            $propertyName = self::getPropertyName($getter);

            if ($propertyName !== null && $method->isPublic() && !$method->isStatic()) {

                $propertyInfo = new PropertyMetadata();
                $setter       = self::getSetterName($propertyName);

                self::setReturnTypeInfo($propertyInfo, $method);

                $propertyInfo->setName($propertyName);
                $propertyInfo->setReadOnly(!$objectMetadata->hasMethod($setter));
                $propertyInfo->setGetter($getter);
                $propertyInfo->setSetter($setter);

                $objectMetadata->addProperty($propertyInfo);
            }
        }

        return $objectMetadata;
    }

    private static function setReturnTypeInfo(PropertyMetadata $propertyInfo, ReflectionMethod $method)
    {
        $returnType = $method->getReturnType();

        if ($returnType) {
            $propertyInfo->setType((string)$returnType);
            $propertyInfo->setNullable($returnType->allowsNull());
            $propertyInfo->setBuiltIn($returnType->isBuiltin());
        } else {

            $result = preg_match('/@return ([\w].)/', $method->getDocComment(), $matches);

            $type = ($result === 1)
                ? $matches[1]
                : 'mixed';

            $propertyInfo->setType($type);
            $propertyInfo->setNullable(true);
            $propertyInfo->setBuiltIn(false);
        }
    }

    private static function getPropertyName(string $methodName)
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

    private static function getSetterName(string $propertyName)
    {
        $propertyName[0] = strtoupper($propertyName[0]);

        return 'set' . $propertyName;
    }
}