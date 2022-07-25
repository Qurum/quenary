<?php

declare(strict_types=1);

namespace Qurum\Quenary\Attributes\Handler;

use Attribute;
use Qurum\Quenary\Attributes\EventType;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_METHOD)]
abstract class MessageHandler
{
    public function __construct(private readonly EventType $value) {}

    public function type(): EventType
    {
        return $this->value;
    }
}
