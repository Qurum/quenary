<?php

declare(strict_types=1);

namespace Quenary\Tests\HandlerManager;

use Generator;
use Quenary\Core\ClassManager;
use ReflectionClass;

class ClassManagerStub implements ClassManager
{
    public function interfaces(): Generator
    {
        foreach ([
                new ReflectionClass(SomeInterface1::class),
                new ReflectionClass(SomeInterface2::class),
                new ReflectionClass(SomeInterface3::class),
            ] as $interface
        ) {
            yield $interface;
        };
    }
}