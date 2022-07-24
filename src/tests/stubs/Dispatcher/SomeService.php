<?php

declare(strict_types=1);

namespace Qenary\Tests\Dispatcher;

use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Attributes\Handler\EventHandler;
use Qenary\Attributes\Handler\QueryHandler;
use Qenary\Tests\Dispatcher\EventTypes;

class SomeService implements SomeInterface
{
    private static SomeInterface $mock;

    public static function injectMock(SomeInterface $mock)
    {
        self::$mock = $mock;
    }

    #[EventHandler(EventTypes::RED_EVENT)] public function redEvent(DataObjectStub $d)
    {
        self::$mock->redEvent($d);
    }

    #[CommandHandler(EventTypes::BAR_COMMAND)] public function barCommand(DataObjectStub $d)
    {
        self::$mock->barCommand($d);
    }

    #[QueryHandler(EventTypes::GREEN_QUERY)] public function greenQuery(DataObjectStub $d)
    {
        self::$mock->greenQuery($d);
    }
}