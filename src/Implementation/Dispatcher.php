<?php

declare(strict_types=1);

namespace Quenary\Implementation;

use Quenary\Core\Autoloader;
use Quenary\Core\Dispatcher as AbstractDispatcher;
use Quenary\Core\MessageHandlerDTO;

class Dispatcher extends AbstractDispatcher
{
    /**
     * @param Autoloader $autoloader
     * @return MessageHandlerDTO[][]
     */
    protected function convertConfigToHandlers(Autoloader $autoloader): array
    {
        $result   = [];
        $loadedHandlers = $autoloader->load();

        foreach ($loadedHandlers['command'] as $type => $handlers) {
            foreach ($handlers as $handler) {
                $result[$type][] = new MessageHandlerDTO(
                    type   : $type,
                    class  : $handler['class'],
                    method : $handler['method'],
                    message: $handler['command'],
                );
            }
        }

        foreach ($loadedHandlers['event'] as $type => $handlers) {
            foreach ($handlers as $handler) {
                $result[$type][] = new MessageHandlerDTO(
                    type   : $type,
                    class  : $handler['class'],
                    method : $handler['method'],
                    message: $handler['event'],
                );
            }
        }

        foreach ($loadedHandlers['query'] as $type => $handlers) {
            foreach ($handlers as $handler) {
                $result[$type][] = new MessageHandlerDTO(
                    type   : $type,
                    class  : $handler['class'],
                    method : $handler['method'],
                    message: $handler['query'],
                );
            }
        }

        return $result;
    }
}