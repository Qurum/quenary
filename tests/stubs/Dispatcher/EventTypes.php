<?php

declare(strict_types=1);

namespace Quenary\Tests\Dispatcher;

use Quenary\Attributes\EventType;

enum EventTypes: string implements EventType
{
    case RED_EVENT = 'RED_EVENT';
    case BAR_COMMAND = 'BAR_COMMAND';
    case GREEN_QUERY = 'GREEN_QUERY';
}