<?php

declare(strict_types=1);

namespace Qenary\Tests\HandlerManager;

use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Attributes\Handler\QueryHandler;
use Qenary\Attributes\Handler\EventHandler;

interface SomeInterface2
{
    #[EventHandler(EventTypes::BLUE_EVENT)]
    #[EventHandler(EventTypes::RED_EVENT)]
    public function method1FromInterface2(DataObjectStub $d);

    public function method2FromInterface2(DataObjectStub $d);

    #[CommandHandler(EventTypes::FOO_COMMAND)]
    public function method3FromInterface2(DataObjectStub $d);

    #[QueryHandler(EventTypes::GREEN_QUERY)]
    public function method4FromInterface2(DataObjectStub $d);
}