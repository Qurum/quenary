<?php

declare(strict_types=1);

namespace Qurum\Quenary;

use DI\Container;
use DI\ContainerBuilder;
use Qurum\Quenary\Core\Autoloader;
use Qurum\Quenary\Core\ClassManager;
use Qurum\Quenary\Core\ConfigManager;
use Qurum\Quenary\Core\Dispatcher;
use Qurum\Quenary\Core\HandlerFactory;
use Qurum\Quenary\Core\HandlerManager;
use Qurum\Quenary\Core\Hydrator\Hydrator;
use Qurum\Quenary\Implementation\Autoloader as AutoloaderImplementation;
use Qurum\Quenary\Implementation\ClassManager\ClassManager as ClassManagerImplementation;
use Qurum\Quenary\Implementation\ConfigManager as ConfigManagerImplementation;
use Qurum\Quenary\Implementation\DefaultPaths;
use Qurum\Quenary\Implementation\Dispatcher as DispatcherImplementation;
use Qurum\Quenary\Implementation\HandlerFactory\HandlerFactory as HandlerFactoryImplementation;
use Qurum\Quenary\Implementation\Hydrator\Hydrator as HydratorImplementation;
use Qurum\Quenary\Implementation\Paths;
use Qurum\Quenary\Implementation\ProxyHandlerManager;

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