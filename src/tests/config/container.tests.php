<?php

declare(strict_types=1);

use Qenary\Core\ClassManager;
use Qenary\Core\Hydrator\Hydrator;
use Qenary\Implementation\ClassManager\ClassManager as ClassManagerImplementation;
use Qenary\Implementation\Hydrator\Hydrator as HydratorImplementation;
use Qenary\Tests\ClassManager\ComposerMock;

return [
    Hydrator::class     => DI\autowire(HydratorImplementation::class),
    ClassManager::class => DI\autowire(ClassManagerImplementation::class)
        ->constructorParameter('composer', DI\autowire(ComposerMock::class))
        ->constructorParameter('namespace', 'Qenary'),
];
