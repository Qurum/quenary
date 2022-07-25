<?php

declare(strict_types=1);

namespace Quenary;

use DI\Container;
use DI\ContainerBuilder;
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

class Quenary
{
    private static ?Dispatcher $dispatcher = null;
    private static ?Container  $container = null;

    public static function dispatcher(): Dispatcher
    {
        if (is_null(self::$container)) {
            self::buildContainer();
        }

        if (is_null(self::$dispatcher)) {
            self::$dispatcher = self::$container->get(Dispatcher::class);
        }

        return self::$dispatcher;
    }

    private static function buildContainer()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(
            [
                Paths::class          => \DI\autowire(DefaultPaths::class),
                ClassManager::class   => \DI\autowire(ClassManagerImplementation::class)
                    ->constructorParameter('namespace', \DI\env('QENARY_NAMESPACE')),
                ConfigManager::class  => \DI\autowire(ConfigManagerImplementation::class),
                HandlerManager::class => \DI\autowire(ProxyHandlerManager::class),
                HandlerFactory::class => \DI\autowire(HandlerFactoryImplementation::class),
                Hydrator::class       => \DI\autowire(HydratorImplementation::class),
                Dispatcher::class     => \DI\autowire(DispatcherImplementation::class),
                Autoloader::class     => \DI\autowire(AutoloaderImplementation::class),
            ]
        );
        self::$container = $builder->build();
    }
}