<?php

declare(strict_types=1);

namespace Quenary\Attributes\Handler;

use Attribute;
use Quenary\Attributes\EventType;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_METHOD)]
abstract class MessageHandler
{
    public function __construct(private readonly EventType $value) {}

    public function type(): EventType
    {
        return $this->value;
    }
}
