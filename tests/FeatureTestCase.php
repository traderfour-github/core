<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class FeatureTestCase extends TestCase
{
    use RefreshDatabase;

    protected static function assertArrayHasKeys(array $keys, array $subject): void
    {
        foreach ($keys as $key) {
            self::assertArrayHasKey($key, $subject);
        }
    }

    protected static function assertArrayHasKeysAndValues(array $keysAndValues, array $subject): void
    {
        foreach ($keysAndValues as $key => $value) {
            self::assertArrayHasKey($key, $subject);
            self::assertEquals($value, $subject[$key]);
        }
    }

    protected function assertArrayIsSimilar(array $expected, ?array $actual)
    {
        $message = "The expected array %s does not similar to actual %s";

        if (is_null($actual)) {
            $this->assertTrue(false, sprintf($message, '[' . implode(', ', $expected) . ']', 'null'));
        } else {
            $this->assertTrue(
                empty(array_diff($expected, $actual)),
                sprintf($message, '[' . implode(', ', $expected) . ']', '[' . implode(', ', $actual) . ']')
            );
        }
    }

    protected function assertResponseMessageContains(string $actual, array $expected)
    {
        $this->assertTrue(
            in_array($actual, $expected),
            "The message is \"{$actual}\" but should contain one of these messages: " . implode(' | ', $expected)
        );
    }
}
