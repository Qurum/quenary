<?php

declare(strict_types=1);

use Quenary\Implementation\Autoloader as AutoloaderImplementation;
use Quenary\Implementation\ClassManager\ClassManager as ClassManagerImplementation;
use Quenary\Implementation\Dispatcher as DispatcherImplementation;
use Quenary\Implementation\HandlerFactory\HandlerFactory as HandlerFactoryImplementation;
use Quenary\Implementation\Hydrator\Hydrator as HydratorImplementation;
use Quenary\Implementation\ProxyHandlerManager;
use Quenary\Tests\Autoloader\ConfigManagerStub;
use Quenary\Tests\Autoloader\HandlerManagerStub;
use Quenary\Tests\ClassManager\ComposerMock;
use Quenary\Tests\Dispatcher\AutoloaderStub;
use Quenary\Tests\HandlerManager\ClassManagerStub;

return [
    'Tests_Hydrator'       => DI\autowire(HydratorImplementation::class),

    'Tests_ClassManager'   => DI\autowire(ClassManagerImplementation::class)
        ->constructorParameter('composer', DI\autowire(ComposerMock::class))
        ->constructorParameter('namespace', 'Quenary'),

    'Tests_HandlerFactory' => DI\autowire(HandlerFactoryImplementation::class),

    'Tests_HandlerManager' => DI\autowire(ProxyHandlerManager::class)
        ->constructorParameter('classManager', DI\autowire(ClassManagerStub::class)),

    'Tests_Dispatcher' => DI\autowire(DispatcherImplementation::class)
        ->constructorParameter('autoloader', DI\autowire(AutoloaderStub::class)),

    'Tests_Autoloader' => DI\autowire(AutoloaderImplementation::class)
        ->constructorParameter('configManager', DI\autowire(ConfigManagerStub::class))
        ->constructorParameter('handlerManager', DI\autowire(HandlerManagerStub::class)),
];
