<?php

declare(strict_types=1);

namespace Qenary\Core;

use ReflectionClass;

interface HandlerFactory
{
    public function createHandlersFor(ReflectionClass $class, string $handlerClassName);
}