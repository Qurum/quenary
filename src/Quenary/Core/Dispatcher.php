<?php

declare(strict_types=1);

namespace Quenary\Core;

use Psr\Container\ContainerInterface;
use Quenary\Core\Hydrator\Hydrator;

abstract class Dispatcher
{
    private array $handlers;

    public function __construct(
        private readonly Hydrator           $hydrator,
        private readonly ContainerInterface $container,
        Autoloader                          $autoloader,
    )
    {
        $this->handlers = $this->convertConfigToHandlers($autoloader);
    }

    public function dispatch(string $type, ?string $json = null): void
    {
        if (array_key_exists($type, $this->handlers)) {
            foreach ($this->handlers[$type] as $handler) {
                $message = $this->hydrator->hydrate($handler->message, $json);
                $this->container->get($handler->class)->{$handler->method}($message);
            }
        }
    }

    /**
     * @param Autoloader $autoloader
     * @return MessageHandlerDTO[][]
     */
    abstract protected function convertConfigToHandlers(Autoloader $autoloader): array;
}