<?php

declare(strict_types=1);

namespace Quenary\Tests\HandlerManager;

use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\QueryHandler;
use Quenary\Attributes\Handler\EventHandler;

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