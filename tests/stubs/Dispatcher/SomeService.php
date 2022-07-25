<?php

declare(strict_types=1);

namespace Quenary\Tests\Dispatcher;

use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\EventHandler;
use Quenary\Attributes\Handler\QueryHandler;
use Quenary\Tests\Dispatcher\EventTypes;

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