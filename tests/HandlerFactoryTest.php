<?php

declare(strict_types=1);

namespace Quenary\Tests;

use PHPUnit\Framework\TestCase;
use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\EventHandler;
use Quenary\Attributes\Handler\QueryHandler;
use Quenary\Core\HandlerFactory;
use Quenary\Core\HandlerFactory\Exceptions\CommandNotSetException;
use Quenary\Core\MessageHandlerDTO;
use Quenary\Tests\HandlerFactory\EventTypes;
use Quenary\Tests\HandlerFactory\SomeInterface;
use Quenary\Tests\HandlerFactory\SomeInterfaceForException;
use Quenary\Tests\HandlerFactory\ValidMessage;
use ReflectionClass;

class HandlerFactoryTest extends TestCase
{
    private HandlerFactory $handlerFactory;

    public function setUp(): void
    {
        $this->handlerFactory = container('Tests_HandlerFactory');
    }

    public function testCreateHandlersFor()
    {
        self::assertEqualsCanonicalizing(
            [
                new MessageHandlerDTO(
                    type   : EventTypes::BLUE_EVENT->value,
                    class  : SomeInterface::class,
                    method : 'method1',
                    message: ValidMessage::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::RED_EVENT->value,
                    class  : SomeInterface::class,
                    method : 'method1',
                    message: ValidMessage::class
                ),
            ],
            $this->handlerFactory->createHandlersFor(
                new ReflectionClass(SomeInterface::class),
                EventHandler::class
            )
        );

        self::assertEqualsCanonicalizing(
            [
                new MessageHandlerDTO(
                    type   : EventTypes::BAR_COMMAND->value,
                    class  : SomeInterface::class,
                    method : 'method2',
                    message: ValidMessage::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::FOO_COMMAND->value,
                    class  : SomeInterface::class,
                    method : 'method3',
                    message: ValidMessage::class
                ),
                new MessageHandlerDTO(
                    type   : EventTypes::BAR_COMMAND->value,
                    class  : SomeInterface::class,
                    method : 'method3',
                    message: ValidMessage::class
                ),
            ],
            $this->handlerFactory->createHandlersFor(
                new ReflectionClass(SomeInterface::class),
                CommandHandler::class
            )
        );

        self::assertEqualsCanonicalizing(
            [
                new MessageHandlerDTO(
                    type   : EventTypes::GREEN_QUERY->value,
                    class  : SomeInterface::class,
                    method : 'method4',
                    message: ValidMessage::class
                )
            ],
            $this->handlerFactory->createHandlersFor(
                new ReflectionClass(SomeInterface::class),
                QueryHandler::class
            )
        );
    }

    public function testCreateHandlersForCommandNotSetException()
    {
        $this->expectException(CommandNotSetException::class);

        $this->handlerFactory->createHandlersFor(
            new ReflectionClass(SomeInterfaceForException::class),
            EventHandler::class
        );
    }
}
