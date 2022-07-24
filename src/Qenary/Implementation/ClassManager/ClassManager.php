<?php

declare(strict_types=1);

namespace Qenary\Implementation\ClassManager;

use Generator;
use Monolog\Logger;
use Qenary\Core\ClassManager as ClassManagerInterface;
use ReflectionClass;

class ClassManager implements ClassManagerInterface
{
    public function __construct(
        private readonly Logger $logger,
        private readonly Composer $composer,
        private readonly string $namespace
    ) {}

    public function interfaces(): Generator
    {
        $this->logger->info(Messages::GENERATION_STARTED->value);
        $this->composer->execute();
        $this->logger->info(Messages::GENERATION_COMPLETED->value);

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