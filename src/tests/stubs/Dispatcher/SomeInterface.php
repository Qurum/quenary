<?php

declare(strict_types=1);

namespace Qenary\Tests\Dispatcher;

use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Attributes\Handler\EventHandler;
use Qenary\Attributes\Handler\QueryHandler;
use Qenary\Tests\Dispatcher\EventTypes;

interface SomeInterface
{
    #[EventHandler(EventTypes::RED_EVENT)]
    public function redEvent(DataObjectStub $d);

    #[CommandHandler(EventTypes::BAR_COMMAND)]
    public function barCommand(DataObjectStub $d);

    #[QueryHandler(EventTypes::GREEN_QUERY)]
    public function greenQuery(DataObjectStub $d);
}