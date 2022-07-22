<?php

declare(strict_types=1);

namespace Qenary\Implementation\ClassManager;

use Generator;
use Monolog\Logger;
use ReflectionClass;

class ClassManager implements \Qenary\Core\ClassManager
{
    private readonly string $namespace;

    public function __construct(private readonly Logger $logger) {}

    public function interfaces(): Generator
    {
        $this->logger->info(Messages::GENERATION_STARTED->value);
        exec(Composer::COMMAND->value);
        $this->logger->info(Messages::GENERATION_COMPLETED->value);

        $classes = require(Composer::PATH_TO_CLASSMAP->value);
        $classes = array_keys($classes);
        $classes = array_filter(
            $classes,
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

    public function injectNamespace(string $namespace)
    {
        $this->namespace = $namespace;
    }
}