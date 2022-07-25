<?php

declare(strict_types=1);

namespace Quenary;

use DI\Container;
use DI\ContainerBuilder;
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

class Quenary
{
    private static ?Dispatcher $dispatcher;
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