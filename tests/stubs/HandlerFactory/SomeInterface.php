<?php

declare(strict_types=1);

namespace Qenary\Tests\HandlerFactory;

use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Attributes\Handler\QueryHandler;
use Qenary\Attributes\Handler\EventHandler;

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