<?php

namespace App\Domain;

use Quenary\Attributes\EventType as EventTypesInterface;

enum ArticleEventTypes: string implements EventTypesInterface
{
    case Command = 'huldufolk.command';
    case Query = 'huldufolk.query';
    case Event = 'huldufolk.event';
}