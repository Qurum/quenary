<?php

declare(strict_types=1);

namespace Qenary\Tests\HandlerFactory;

use Qenary\Attributes\Handler\EventHandler;

interface SomeInterfaceForException
{
    #[EventHandler(EventTypes::BLUE_EVENT)]
    public function method1();
}