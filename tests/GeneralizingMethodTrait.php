<?php

namespace Tests;

use ReflectionClass;
use ReflectionMethod;

trait GeneralizingMethodTrait
{
    public static function getPublicMethod(string $className, string $methodName): ReflectionMethod
    {
        $class  = new ReflectionClass($className);
        $method = $class->getMethod($methodName);

        $method->setAccessible(true);

        return $method;
    }
}
