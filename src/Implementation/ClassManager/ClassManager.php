<?php

declare(strict_types=1);

namespace Quenary\Implementation\ClassManager;

use Generator;
use Quenary\Core\ClassManager as ClassManagerInterface;
use ReflectionClass;

class ClassManager implements ClassManagerInterface
{
    public function __construct(
        private readonly Composer $composer,
        private readonly string $namespace
    ) {}

    public function interfaces(): Generator
    {
        $this->composer->execute();

        $classes = array_filter(
            $this->composer->classes(),
            fn($className) => str_starts_with($className, $this->namespace)
        );

        foreach ($classes as $className) {
            $class = new ReflectionClass($className);

            if (!$class->isInterface()) {
                continue;
            }

            yield $class;
        }
    }
}