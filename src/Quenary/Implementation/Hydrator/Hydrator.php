<?php

declare(strict_types=1);

namespace Quenary\Implementation\Hydrator;

use JsonException;
use Quenary\Core\Hydrator\Hydrator as HydratorInterface;
use Quenary\Core\Hydrator\Exceptions\CannotInstantiate;
use Quenary\Core\Hydrator\Exceptions\ClassDoesNotExist;
use Quenary\Core\Hydrator\Exceptions\NoProperty;
use Quenary\Core\Hydrator\Exceptions\NotAllowNull;
use Quenary\Core\Hydrator\Exceptions\WrongJson;
use Quenary\Core\Hydrator\Exceptions\WrongType;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class Hydrator implements HydratorInterface
{
    public function hydrate(string $className, string $jsonString): object
    {
        try {
            $reflectionClass = new ReflectionClass($className);
        } catch (ReflectionException) {
            throw new ClassDoesNotExist(sprintf(ErrorMessages::ClassDoesNotExist->value, $className));
        }

        try {
            $instance = $reflectionClass->newInstanceWithoutConstructor();
        } catch (ReflectionException) {
            throw new CannotInstantiate(sprintf(ErrorMessages::CannotInstantiate->value, $command_name));
        }

        try {
            $json = json_decode($jsonString, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            throw new WrongJson(ErrorMessages::WrongJson->value);
        }


        foreach ($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $propertyName = $property->getName();

            if (!property_exists($json, $propertyName)) {
                throw new NoProperty(
                    sprintf(ErrorMessages::Hydration_NoProperty->value, '$JSON', $propertyName)
                );
            }

            switch (get_debug_type($json->{$propertyName})) {

                case 'null':
                    if (!$property->getType()->allowsNull()) {
                        throw new NotAllowNull(
                            sprintf(
                                ErrorMessages::Hydration_NotAllowNull->value,
                                '$instance->' . $propertyName,
                                $property->getType()->getName()
                            )
                        );
                    };
                    break;

                default:
                    if (get_debug_type($json->{$propertyName}) !== $property->getType()->getName()) {
                        throw new WrongType(
                            sprintf(
                                ErrorMessages::Hydration_WrongType->value,
                                '$JSON->' . $propertyName,
                                get_debug_type($json->{$propertyName}),
                                '$instance->' . $propertyName,
                                $property->getType()->getName()
                            )
                        );
                    }
                    break;
            }

            $property->setValue($instance, $json->{$propertyName});
        }

        return $instance;
    }
}