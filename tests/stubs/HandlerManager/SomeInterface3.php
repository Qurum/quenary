<?php

declare(strict_types=1);

namespace Quenary\Tests\HandlerManager;

use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\QueryHandler;
use Quenary\Attributes\Handler\EventHandler;

interface SomeInterface3
{
    #[CommandHandler(EventTypes::BAR_COMMAND)]
    public function method1FromInterface3(DataObjectStub $d);

    #[QueryHandler(EventTypes::GREEN_QUERY)]
    public function method2FromInterface3(DataObjectStub $d);
}