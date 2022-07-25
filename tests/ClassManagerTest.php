<?php

declare(strict_types=1);

namespace Quenary\Tests;

use PHPUnit\Framework\TestCase;
use Quenary\Core\ClassManager;
use Quenary\Tests\ClassManager\ComposerMock;
use ReflectionClass;

class ClassManagerTest extends TestCase
{
    public function testInterfaces()
    {
        $classManager = container('Tests_ClassManager');
        $composerMock = container(ComposerMock::class);

        $interfaces = [];
        foreach($classManager->interfaces() as $interface)
        {
            /** @var ReflectionClass $interface */
            $interfaces[] = $interface->getName();
        }

        self::assertEqualsCanonicalizing($composerMock->interfaces(), $interfaces);
    }
}
