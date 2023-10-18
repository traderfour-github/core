<?php

namespace Tests;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use ReflectionClass;

abstract class UnitTestCase extends MockeryTestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        $props = $this->getCurrentTestClassProperties();
        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $prop->setValue($this, null);
        }

        Mockery::close();
    }

    private function getCurrentTestClassProperties(): array
    {
        $testClassName = get_class($this);
        $class         = new ReflectionClass($testClassName);

        return array_filter(
            $class->getProperties(),
            function ($property) use ($testClassName) {
                return $property->class === $testClassName;
            }
        );
    }
}
