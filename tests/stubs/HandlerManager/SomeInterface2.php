<?php

declare(strict_types=1);

namespace Quenary\Tests\HandlerManager;

use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\QueryHandler;
use Quenary\Attributes\Handler\EventHandler;

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