<?php

declare(strict_types=1);

namespace Qenary\Tests;

use PHPUnit\Framework\TestCase;
use Qenary\Core\HandlerManager;
use Qenary\Core\MessageHandlerDTO;
use Qenary\Tests\HandlerManager\DataObjectStub;
use Qenary\Tests\HandlerManager\EventTypes;
use Qenary\Tests\HandlerManager\SomeInterface1;
use Qenary\Tests\HandlerManager\SomeInterface2;
use Qenary\Tests\HandlerManager\SomeInterface3;

class HandlerManagerTest extends TestCase
{
    private HandlerManager $handlerManager;

    public function setUp(): void
    {
        $this->handlerManager = container('Tests_HandlerManager');
    }

    public function testGetCommandHandlers()
    {
        self::assertEqualsCanonicalizing(
            [
                new MessageHandlerDTO(
                    type   : EventTypes::BAR_COMMAND->value,
                    class  : SomeInterface1::class,
                    method : 'method2FromInterface1',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::FOO_COMMAND->value,
                    class  : SomeInterface1::class,
                    method : 'method3FromInterface1',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::BAR_COMMAND->value,
                    class  : SomeInterface1::class,
                    method : 'method3FromInterface1',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::FOO_COMMAND->value,
                    class  : SomeInterface2::class,
                    method : 'method3FromInterface2',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::BAR_COMMAND->value,
                    class  : SomeInterface3::class,
                    method : 'method1FromInterface3',
                    message: DataObjectStub::class
                ),
            ],
            $this->handlerManager->getCommandHandlers()
        );
    }

    public function testGetQueryHandlers()
    {
        self::assertEqualsCanonicalizing(
            [
                new MessageHandlerDTO(
                    type   : EventTypes::GREEN_QUERY->value,
                    class  : SomeInterface1::class,
                    method : 'method4FromInterface1',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::GREEN_QUERY->value,
                    class  : SomeInterface2::class,
                    method : 'method4FromInterface2',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::GREEN_QUERY->value,
                    class  : SomeInterface3::class,
                    method : 'method2FromInterface3',
                    message: DataObjectStub::class
                ),
            ],
            $this->handlerManager->getQueryHandlers()
        );
    }

    public function testGetEventHandlers() {
        self::assertEqualsCanonicalizing(
            [
                new MessageHandlerDTO(
                    type   : EventTypes::BLUE_EVENT->value,
                    class  : SomeInterface1::class,
                    method : 'method1FromInterface1',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::RED_EVENT->value,
                    class  : SomeInterface1::class,
                    method : 'method1FromInterface1',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::BLUE_EVENT->value,
                    class  : SomeInterface2::class,
                    method : 'method1FromInterface2',
                    message: DataObjectStub::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::RED_EVENT->value,
                    class  : SomeInterface2::class,
                    method : 'method1FromInterface2',
                    message: DataObjectStub::class
                ),
            ],
            $this->handlerManager->getEventHandlers()
        );
    }
}
