<?php

declare(strict_types=1);

namespace Quenary\Tests\DataObject;

use stdClass;

/**
 * DataObjectVariantsBuilder
 *
 * # Example:
 *
 * $variants = new DataObjectVariantsBuilder();
 * $variants->with('int');
 * $variants->with('string', true);
 * $variants->with('bool');
 * $variants->getVariants();
 *
 * # This will return:
 * [
 *   {'intField' : 42, 'stringField' : 'Some string value', true},
 *   {'intField' : 42, 'stringField' : null, true},
 * ]
 * - an array of stdClass objects
 */
class DataObjectVariantsBuilder
{
    use Types;

    private array $types = [];

    /**
     * For each nullable type there is a variant with null field.
     */
    public function getVariants(): \Generator
    {
        $prototype = $this->getPrototype();

        yield $prototype;

        foreach ($this->types as $type) {
            if ($type['nullable']) {
                $variant                  = clone $prototype;
                $variant->{$type['type']} = null;
                yield $variant;
            }
        }
    }

    /**
     * @param string $type
     * @param bool   $nullable
     * @return void
     */
    public function with(string $type, bool $nullable = false): void
    {
        $this->types[] = [
            'type'     => $type,
            'nullable' => $nullable
        ];
    }

    public function getPrototype(): stdClass
    {
        $result = new stdClass();
        foreach ($this->types as $type) {
            $result->{$type['type']} = $this->getValueForType($type['type']);
        }

        return $result;
    }
}