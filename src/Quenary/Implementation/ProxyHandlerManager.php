<?php

declare(strict_types=1);

namespace Quenary\Implementation;

use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\EventHandler;
use Quenary\Attributes\Handler\QueryHandler;
use Quenary\Core\ClassManager;
use Quenary\Core\HandlerFactory;
use Quenary\Core\HandlerManager;

class ProxyHandlerManager implements HandlerManager
{
    private ?array $cachedHandlers = null;

    public function __construct(
        private readonly ClassManager   $classManager,
        private readonly HandlerFactory $handlerFactory,
    ) {}

    public function getCommandHandlers()
    {
        return $this->handlers(CommandHandler::class) ?? [];
    }

    public function getQueryHandlers()
    {
        return $this->handlers(QueryHandler::class) ?? [];
    }

    public function getEventHandlers()
    {
        return $this->handlers(EventHandler::class) ?? [];
    }

    private function handlers(string $type)
    {
        if (is_null($this->cachedHandlers)) {
            $this->createHandlers();
        }

        return $this->cachedHandlers[$type];
    }

    private function createHandlers()
    {
        foreach ($this->classManager->interfaces() as $class) {
            $this->cachedHandlers[CommandHandler::class] =
                array_merge(
                    $this->handlerFactory->createHandlersFor($class, CommandHandler::class),
                    $this->cachedHandlers[CommandHandler::class] ?? []
                );

            $this->cachedHandlers[QueryHandler::class] =
                array_merge(
                    $this->handlerFactory->createHandlersFor($class, QueryHandler::class),
                    $this->cachedHandlers[QueryHandler::class] ?? []
                );

            $this->cachedHandlers[EventHandler::class] =
                array_merge(
                    $this->handlerFactory->createHandlersFor($class, EventHandler::class),
                    $this->cachedHandlers[EventHandler::class] ?? []
                );
        }
    }
}