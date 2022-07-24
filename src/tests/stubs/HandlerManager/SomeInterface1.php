<?php

declare(strict_types=1);

namespace Qenary\Tests\HandlerManager;

use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Attributes\Handler\QueryHandler;
use Qenary\Attributes\Handler\EventHandler;

interface SomeInterface1
{
    #[EventHandler(EventTypes::BLUE_EVENT)]
    #[EventHandler(EventTypes::RED_EVENT)]
    public function method1FromInterface1(DataObjectStub $d);

    #[CommandHandler(EventTypes::BAR_COMMAND)]
    public function method2FromInterface1(DataObjectStub $d);

    #[CommandHandler(EventTypes::FOO_COMMAND)]
    #[CommandHandler(EventTypes::BAR_COMMAND)]
    public function method3FromInterface1(DataObjectStub $d);

    #[QueryHandler(EventTypes::GREEN_QUERY)]
    public function method4FromInterface1(DataObjectStub $d);

    public function method5FromInterface1(DataObjectStub $d);
}