<?php

use Qenary\Core\Autoloader;
use Qenary\Core\ClassManager;
use Qenary\Core\ConfigManager;
use Qenary\Core\Dispatcher;
use Qenary\Core\HandlerFactory;
use Qenary\Core\HandlerManager;
use Qenary\Core\Hydrator\Hydrator;
use Qenary\Implementation\Autoloader as AutoloaderImplementation;
use Qenary\Implementation\ClassManager\ClassManager as ClassManagerImplementation;
use Qenary\Implementation\ConfigManager as ConfigManagerImplementation;
use Qenary\Implementation\DefaultPaths;
use Qenary\Implementation\Dispatcher as DispatcherImplementation;
use Qenary\Implementation\HandlerFactory\HandlerFactory as HandlerFactoryImplementation;
use Qenary\Implementation\Hydrator\Hydrator as HydratorImplementation;
use Qenary\Implementation\Paths;
use Qenary\Implementation\ProxyHandlerManager;


return [
    Paths::class          => DI\autowire(DefaultPaths::class),
    ClassManager::class   => DI\autowire(ClassManagerImplementation::class)
        ->constructorParameter('namespace', DI\env('QENARY_NAMESPACE')),
    ConfigManager::class  => DI\autowire(ConfigManagerImplementation::class),
    HandlerManager::class => DI\autowire(ProxyHandlerManager::class),
    HandlerFactory::class => DI\autowire(HandlerFactoryImplementation::class),
    Hydrator::class       => DI\autowire(HydratorImplementation::class),
    Dispatcher::class     => DI\autowire(DispatcherImplementation::class),
    Autoloader::class     => DI\autowire(AutoloaderImplementation::class),
];