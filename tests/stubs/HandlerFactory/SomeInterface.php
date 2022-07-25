<?php

declare(strict_types=1);

namespace Quenary\Tests\HandlerFactory;

use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\QueryHandler;
use Quenary\Attributes\Handler\EventHandler;

interface SomeInterface
{
    #[EventHandler(EventTypes::BLUE_EVENT)]
    #[EventHandler(EventTypes::RED_EVENT)]
    public function method1(ValidMessage $d);

    #[CommandHandler(EventTypes::BAR_COMMAND)]
    public function method2(ValidMessage $d);

    #[CommandHandler(EventTypes::FOO_COMMAND)]
    #[CommandHandler(EventTypes::BAR_COMMAND)]
    public function method3(ValidMessage $d);

    #[QueryHandler(EventTypes::GREEN_QUERY)]
    public function method4(ValidMessage $d);

    public function method5(ValidMessage $d);
}