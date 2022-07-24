<?php

declare(strict_types=1);

use Qenary\Implementation\ClassManager\ClassManager as ClassManagerImplementation;
use Qenary\Implementation\HandlerFactory\HandlerFactory as HandlerFactoryImplementation;
use Qenary\Implementation\Hydrator\Hydrator as HydratorImplementation;
use Qenary\Implementation\ProxyHandlerManager;
use Qenary\Tests\ClassManager\ComposerMock;
use Qenary\Tests\HandlerManager\ClassManagerStub;

return [
    'Tests_Hydrator'       => DI\autowire(HydratorImplementation::class),
    'Tests_ClassManager'   => DI\autowire(ClassManagerImplementation::class)
        ->constructorParameter('composer', DI\autowire(ComposerMock::class))
        ->constructorParameter('namespace', 'Qenary'),
    'Tests_HandlerFactory' => DI\autowire(HandlerFactoryImplementation::class),
    'Tests_HandlerManager' => DI\autowire(ProxyHandlerManager::class)
        ->constructorParameter('classManager', DI\autowire(ClassManagerStub::class)),
];
