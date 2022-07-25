<?php

declare(strict_types=1);

namespace Qurum\Quenary\Core;

class MessageHandlerDTO
{
    public function __construct(
        public readonly string $type,
        public readonly string $class,
        public readonly string $method,
        public readonly string $message,
    ) {}
}
