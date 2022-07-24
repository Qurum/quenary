<?php

declare(strict_types=1);

namespace Qenary\Tests\HandlerManager;

use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Attributes\Handler\QueryHandler;
use Qenary\Attributes\Handler\EventHandler;

interface SomeInterface3
{
    #[CommandHandler(EventTypes::BAR_COMMAND)]
    public function method1FromInterface3(DataObjectStub $d);

    #[QueryHandler(EventTypes::GREEN_QUERY)]
    public function method2FromInterface3(DataObjectStub $d);
}