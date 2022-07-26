<?php

declare(strict_types=1);

namespace Quenary\Tests;

use PHPUnit\Framework\TestCase;
use Quenary\Core\Hydrator\Exceptions\ClassDoesNotExist;
use Quenary\Core\Hydrator\Exceptions\NoProperty;
use Quenary\Core\Hydrator\Exceptions\NotAllowNull;
use Quenary\Core\Hydrator\Exceptions\WrongJson;
use Quenary\Implementation\Hydrator\Hydrator;
use Quenary\Tests\DataObject\DataObjectFactory;

class HydratorTest extends TestCase
{
    protected Hydrator                 $hydrator;
    protected static DataObjectFactory $dataObjectFactory;

    public static function setUpBeforeClass(): void
    {
        self::$dataObjectFactory = new DataObjectFactory();
    }

    public function setUp(): void
    {
        $this->hydrator = container('Tests_Hydrator');
    }

    public function testHydrate()
    {
        foreach (self::$dataObjectFactory->provideEquals() as $variant) {
            $this->assertEquals(
                $variant->expectedObject,
                $this->hydrator->hydrate(self::$dataObjectFactory::DATA_OBJECT_CLASSNAME, $variant->JSON)
            );
        }
    }

    public function testHydrateExceptionNoProperty()
    {
        $this->expectException(NoProperty::class);

        foreach (self::$dataObjectFactory->incompleteJSON() as $variant) {
            $this->hydrator->hydrate(self::$dataObjectFactory::DATA_OBJECT_CLASSNAME, $variant->JSON);
        }
    }

    public function testHydrateExceptionWrongJson()
    {
        $this->expectException(WrongJson::class);

        foreach (self::$dataObjectFactory->wrongJson() as $variant) {
            $this->hydrator->hydrate(self::$dataObjectFactory::DATA_OBJECT_CLASSNAME, $variant->JSON);
        }
    }

    public function testHydrateExceptionClassDoesNotExist()
    {
        $this->expectException(ClassDoesNotExist::class);
        $this->hydrator->hydrate('75548f7f_8db2_4a74_b604_cb6afdf7ba19', '{}');
    }

    public function testHydrateExceptionNotAllowNull()
    {
        $this->expectException(NotAllowNull::class);

        foreach (self::$dataObjectFactory->allFieldsAreNull() as $variant) {
            $this->hydrator->hydrate(self::$dataObjectFactory::DATA_OBJECT_CLASSNAME, $variant->JSON);
        }
    }

}
