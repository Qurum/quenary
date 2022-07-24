<?php

declare(strict_types=1);

namespace Qenary\Tests\Dispatcher;

use Qenary\Attributes\EventType;

enum EventTypes: string implements EventType
{
    case RED_EVENT = 'RED_EVENT';
    case BAR_COMMAND = 'BAR_COMMAND';
    case GREEN_QUERY = 'GREEN_QUERY';
}