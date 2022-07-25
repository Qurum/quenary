<?php

declare(strict_types=1);

namespace Quenary\Implementation;

use Quenary\Core\Autoloader as AbstractAutoloader;
use Quenary\Core\HandlerManager;
use Quenary\Core\MessageHandlerDTO;

class Autoloader extends AbstractAutoloader
{
    protected function queries(): array
    {
        $result = [];

        foreach ($this->handlerManager->getQueryHandlers() as $queryHandlerDTO) {
            /** @var MessageHandlerDTO $queryHandlerDTO */
            $handler         = new \stdClass();
            $handler->class  = $queryHandlerDTO->class;
            $handler->method = $queryHandlerDTO->method;
            $handler->query  = $queryHandlerDTO->message;

            $result[$queryHandlerDTO->type][] = $handler;
        }

        return $result;
    }

    protected function events(): array
    {
        $result = [];

        foreach ($this->handlerManager->getEventHandlers() as $eventHandlerDTO) {
            /** @var MessageHandlerDTO $eventHandlerDTO */
            $handler         = new \stdClass();
            $handler->class  = $eventHandlerDTO->class;
            $handler->method = $eventHandlerDTO->method;
            $handler->event  = $eventHandlerDTO->message;

            $result[$eventHandlerDTO->type][] = $handler;
        }

        return $result;
    }

    protected function commands(): array
    {
        $result = [];

        foreach ($this->handlerManager->getCommandHandlers() as $commandHandlerDTO) {
            /** @var MessageHandlerDTO $commandHandlerDTO */
            $handler          = new \stdClass();
            $handler->class   = $commandHandlerDTO->class;
            $handler->method  = $commandHandlerDTO->method;
            $handler->command = $commandHandlerDTO->message;

            $result[$commandHandlerDTO->type][] = $handler;
        }

        return $result;
    }
}