<?php

declare(strict_types=1);

namespace Qenary\Implementation\HandlerFactory;

use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Core\HandlerFactory as HandlerFactoryInterface;
use Qenary\Core\MessageHandlerDTO;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;

class HandlerFactory implements HandlerFactoryInterface
{
    /**
     * @param ReflectionClass $class
     * @param string          $handlerClassName
     * @return MessageHandlerDTO[]
     */
    public function createHandlersFor(ReflectionClass $class, string $handlerClassName): array
    {
        $result = [];

        foreach ($class->getMethods() as $method) {
            foreach ($method->getAttributes($handlerClassName) as $attribute) {
                $result[] = $this->createHandlerDTO($method, $attribute);
            }
        }

        return $result;
    }

    private function createHandlerDTO(
        ReflectionMethod    $method,
        ReflectionAttribute $attribute
    )
    {
        /** @var CommandHandler $handler */
        $handler = $attribute->newInstance();

        return new MessageHandlerDTO (
            type   : $handler->type()->value,
            class  : $method->class,
            method : $method->name,
            message: $method->getParameters()[0]->getType()->getName()
        );
    }
}