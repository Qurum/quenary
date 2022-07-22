<?php

declare(strict_types=1);

namespace Qenary\Implementation\Hydrator;

use Qenary\Core\Hydrator as HydratorInterface;
use Qenary\Implementation\Hydrator\Exceptions\HydratorException;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class Hydrator implements HydratorInterface
{
    public function hydrate(string $className, string $jsonString): object
    {
        try {
            $reflection_class = new ReflectionClass($className);
        } catch (ReflectionException) {
            throw new HydratorException(sprintf(ErrorMessages::ClassDoesNotExist->value, $className));
        }

        try {
            $instance = $reflection_class->newInstanceWithoutConstructor();
        } catch (ReflectionException) {
            throw new HydratorException(sprintf(ErrorMessages::CannotInstantiate->value, $command_name));
        }

        $json = json_decode($jsonString);

        foreach ($reflection_class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $property_name = $property->getName();

            if (!property_exists($json, $property_name)) {
                throw new HydratorException(
                    sprintf(ErrorMessages::Hydration_NoProperty->value, '$JSON', $property_name)
                );
            }

            if (gettype($json->{$property_name}) !== $property->getType()->getName()) {
                throw new HydratorException(
                    sprintf(
                        ErrorMessages::Hydration_WrongType->value,
                        '$JSON->' . $property_name,
                        gettype($json->{$property_name}),
                        '$instance->' . $property_name,
                        $property->getType()->getName()
                    )
                );
            }

            $property->setValue($instance, $json->{$property_name});
        }

        return $instance;
    }
}