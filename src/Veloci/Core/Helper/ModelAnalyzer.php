<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 01:17
 */

namespace Veloci\Core\Helper;


use ReflectionClass;
use ReflectionMethod;

class ModelAnalyzer
{
    public static function analize($object)
    {
        echo "Analyzing model: \n";
        $result = [];

        $class = new ReflectionClass($object);

        $methods = $class->getMethods();

        /** @var ReflectionMethod $method */
        foreach ($methods as $method) {
            $methodName   = $method->getName();
            $propertyInfo = [];

            $propertyName = static::getPropertyName($methodName);

            if ($propertyName && $method->isPublic() && !$method->isStatic()) {

                static::setRerturnTypeInfo($propertyInfo, $method);

                $propertyInfo['readonly'] = !static::hasSetter($propertyName, $class);

                $result [$propertyName] = $propertyInfo;
            }
        }

        return $result;
    }

    private static function setRerturnTypeInfo(array &$propertyInfo, ReflectionMethod $method)
    {
        $returnType = $method->getReturnType();

        $propertyInfo['returnType'] = ($returnType) ? (string)$returnType : 'mixed';
        $propertyInfo['nullable']   = $returnType->allowsNull();
        $propertyInfo['builtIn']    = $returnType->isBuiltin();
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

        $propertyName{0} = strtolower($propertyName{0});

        return $propertyName;
    }

    private static function hasSetter(string $propertyName, ReflectionClass $class):bool
    {
        $propertyName{0} = strtoupper($propertyName{0});

        return $class->hasMethod("set{$propertyName}");
    }
}