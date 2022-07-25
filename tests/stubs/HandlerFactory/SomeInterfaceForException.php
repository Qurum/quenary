<?php

declare(strict_types=1);

namespace Quenary\Tests\HandlerFactory;

use Quenary\Attributes\Handler\EventHandler;

interface SomeInterfaceForException
{
    #[EventHandler(EventTypes::BLUE_EVENT)]
    public function method1();
}