<?php

declare(strict_types=1);

namespace Quenary\Tests\Dispatcher;

use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\EventHandler;
use Quenary\Attributes\Handler\QueryHandler;
use Quenary\Tests\Dispatcher\EventTypes;

interface SomeInterface
{
    #[EventHandler(EventTypes::RED_EVENT)]
    public function redEvent(DataObjectStub $d);

    #[CommandHandler(EventTypes::BAR_COMMAND)]
    public function barCommand(DataObjectStub $d);

    #[QueryHandler(EventTypes::GREEN_QUERY)]
    public function greenQuery(DataObjectStub $d);
}