<?php

declare(strict_types=1);

namespace Qenary\Implementation;

use Qenary\Core\Autoloader;
use Qenary\Core\Dispatcher as AbstractDispatcher;
use Qenary\Core\MessageHandlerDTO;

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