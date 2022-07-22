<?php

declare(strict_types=1);

namespace Qenary\Attributes\Handler;

use Attribute;
use Qenary\Attributes\EventType;

#[Attribute]
abstract class MessageHandler
{
    public function __construct(private readonly EventType $value) {}

    public function type(): EventType
    {
        return $this->value;
    }
}
