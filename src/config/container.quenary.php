<?php

use Quenary\Core\Autoloader;
use Quenary\Core\ClassManager;
use Quenary\Core\ConfigManager;
use Quenary\Core\Dispatcher;
use Quenary\Core\HandlerFactory;
use Quenary\Core\HandlerManager;
use Quenary\Core\Hydrator\Hydrator;
use Quenary\Implementation\Autoloader as AutoloaderImplementation;
use Quenary\Implementation\ClassManager\ClassManager as ClassManagerImplementation;
use Quenary\Implementation\ConfigManager as ConfigManagerImplementation;
use Quenary\Implementation\DefaultPaths;
use Quenary\Implementation\Dispatcher as DispatcherImplementation;
use Quenary\Implementation\HandlerFactory\HandlerFactory as HandlerFactoryImplementation;
use Quenary\Implementation\Hydrator\Hydrator as HydratorImplementation;
use Quenary\Implementation\Paths;
use Quenary\Implementation\ProxyHandlerManager;


return [
    Paths::class          => DI\autowire(DefaultPaths::class),
    ClassManager::class   => DI\autowire(ClassManagerImplementation::class)
        ->constructorParameter('namespace', DI\env('QUENARY_NAMESPACE')),
    ConfigManager::class  => DI\autowire(ConfigManagerImplementation::class),
    HandlerManager::class => DI\autowire(ProxyHandlerManager::class),
    HandlerFactory::class => DI\autowire(HandlerFactoryImplementation::class),
    Hydrator::class       => DI\autowire(HydratorImplementation::class),
    Dispatcher::class     => DI\autowire(DispatcherImplementation::class),
    Autoloader::class     => DI\autowire(AutoloaderImplementation::class),
];