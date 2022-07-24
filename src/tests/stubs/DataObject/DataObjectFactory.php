<?php

declare(strict_types=1);

namespace Qenary\Tests\DataObject;

use ReflectionClass;
use ReflectionProperty;
use stdClass;

class DataObjectFactory
{
    private DataObjectVariantsBuilder $builder;

    public function __construct()
    {
        $this->setUpBuilder();
    }

    public const DATA_OBJECT_CLASSNAME = DataObjectStub::class;

    public function provideEquals(): \Generator
    {
        foreach ($this->builder->getVariants() as $variant) {
            $result                 = new stdClass();
            $result->expectedObject = $this->stdClassToDataObject($variant);
            $result->JSON           = json_encode($variant);

            yield $result;
        };
    }

    public function incompleteJSON(): \Generator
    {
        $result                 = new stdClass();
        $result->expectedObject = $this->builder->getPrototype();
        $result->JSON           = json_encode(new stdClass());

        yield $result;
    }

    public function wrongJson(): \Generator
    {
        $result                 = new stdClass();
        $result->expectedObject = $this->builder->getPrototype();
        $result->JSON           = 'Not a JSON';

        yield $result;
    }

    public function allFieldsAreNull(): \Generator
    {
        $result                 = new stdClass();
        $result->expectedObject = $this->builder->getPrototype();

        $objectWithAllFieldsAreNull = [];
        foreach ((array)($result->expectedObject) as $key => $value) {
            $objectWithAllFieldsAreNull[$key] = null;
        }
        $result->JSON = json_encode($objectWithAllFieldsAreNull);

        yield $result;
    }

    private function stdClassToDataObject($stdObject): ?object
    {
        return (new ReflectionClass(self::DATA_OBJECT_CLASSNAME))
            ->newInstanceArgs((array)$stdObject);
    }

    private function setUpBuilder(): void
    {
        $this->builder   = new DataObjectVariantsBuilder();
        $reflectionClass = new ReflectionClass(self::DATA_OBJECT_CLASSNAME);

        foreach ($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $this->builder->with(
                $property->getType()->getName(),
                $property->getType()->allowsNull()
            );
        }
    }
}