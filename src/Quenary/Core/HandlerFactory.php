<?php

declare(strict_types=1);

namespace Quenary\Core;

use Quenary\Core\HandlerFactory\Exceptions\CommandNotSetException;
use ReflectionClass;

interface HandlerFactory
{
    /**
     * @param ReflectionClass $class
     * @param string          $handlerClassName
     *
     * @return MessageHandlerDTO[]
     *
     * @throws CommandNotSetException
     */
    public function createHandlersFor(ReflectionClass $class, string $handlerClassName): array;
}