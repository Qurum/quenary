<?php

declare(strict_types=1);

namespace Qenary\Tests\HandlerManager;

use Qenary\Attributes\EventType;

enum EventTypes: string implements EventType
{
    case RED_EVENT = 'RED_EVENT';
    case BLUE_EVENT = 'BLUE_EVENT';
    case FOO_COMMAND = 'FOO_COMMAND';
    case BAR_COMMAND = 'BAR_COMMAND';
    case GREEN_QUERY = 'GREEN_QUERY';
}