<?php

declare(strict_types=1);

use Qenary\Implementation\Autoloader as AutoloaderImplementation;
use Qenary\Implementation\ClassManager\ClassManager as ClassManagerImplementation;
use Qenary\Implementation\Dispatcher as DispatcherImplementation;
use Qenary\Implementation\HandlerFactory\HandlerFactory as HandlerFactoryImplementation;
use Qenary\Implementation\Hydrator\Hydrator as HydratorImplementation;
use Qenary\Implementation\ProxyHandlerManager;
use Qenary\Tests\Autoloader\ConfigManagerStub;
use Qenary\Tests\Autoloader\HandlerManagerStub;
use Qenary\Tests\ClassManager\ComposerMock;
use Qenary\Tests\Dispatcher\AutoloaderStub;
use Qenary\Tests\HandlerManager\ClassManagerStub;

return [
    'Tests_Hydrator'       => DI\autowire(HydratorImplementation::class),

    'Tests_ClassManager'   => DI\autowire(ClassManagerImplementation::class)
        ->constructorParameter('composer', DI\autowire(ComposerMock::class))
        ->constructorParameter('namespace', 'Qenary'),

    'Tests_HandlerFactory' => DI\autowire(HandlerFactoryImplementation::class),

    'Tests_HandlerManager' => DI\autowire(ProxyHandlerManager::class)
        ->constructorParameter('classManager', DI\autowire(ClassManagerStub::class)),

    'Tests_Dispatcher' => DI\autowire(DispatcherImplementation::class)
        ->constructorParameter('autoloader', DI\autowire(AutoloaderStub::class)),

    'Tests_Autoloader' => DI\autowire(AutoloaderImplementation::class)
        ->constructorParameter('configManager', DI\autowire(ConfigManagerStub::class))
        ->constructorParameter('handlerManager', DI\autowire(HandlerManagerStub::class)),
];
