<?php

declare(strict_types=1);

namespace Qenary\Tests;

use PHPUnit\Framework\TestCase;
use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Attributes\Handler\EventHandler;
use Qenary\Attributes\Handler\QueryHandler;
use Qenary\Core\HandlerFactory;
use Qenary\Core\HandlerFactory\Exceptions\CommandNotSetException;
use Qenary\Core\MessageHandlerDTO;
use Qenary\Tests\HandlerFactory\EventTypes;
use Qenary\Tests\HandlerFactory\SomeInterface;
use Qenary\Tests\HandlerFactory\SomeInterfaceForException;
use Qenary\Tests\HandlerFactory\ValidMessage;
use ReflectionClass;

class HandlerFactoryTest extends TestCase
{
    private HandlerFactory $handlerFactory;

    public function setUp(): void
    {
        $this->handlerFactory = container(HandlerFactory::class);
    }

    public function testCreateHandlersFor()
    {
        self::assertEquals(
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

        self::assertEquals(
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

        self::assertEquals(
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
