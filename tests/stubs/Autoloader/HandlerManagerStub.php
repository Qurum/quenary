<?php

declare(strict_types=1);

namespace Qenary\Tests\Autoloader;

use Qenary\Core\HandlerManager;
use Qenary\Core\MessageHandlerDTO;

class HandlerManagerStub implements HandlerManager
{
    public function getCommandHandlers(): array
    {
        return [
            new MessageHandlerDTO(
                type   : 'someCommandType1',
                class  : 'SomeInterface',
                method : 'someMethod',
                message: 'SomeDataObject'
            ),
            new MessageHandlerDTO(
                type   : 'someCommandType2',
                class  : 'SomeInterface1',
                method : 'someMethod',
                message: 'SomeDataObject'
            ),
            new MessageHandlerDTO(
                type   : 'someCommandType2',
                class  : 'SomeInterface2',
                method : 'someMethod',
                message: 'SomeDataObject'
            ),
        ];
    }

    public function getQueryHandlers(): array
    {
        return [];
    }

    public function getEventHandlers(): array
    {
        return [
            new MessageHandlerDTO(
                type   : 'someEventType',
                class  : 'SomeInterface',
                method : 'someMethod',
                message: 'SomeDataObject'
            ),
        ];
    }
}