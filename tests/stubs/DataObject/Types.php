<?php

declare(strict_types=1);

namespace Qenary\Tests\DataObject;

trait Types
{
    private function getValueForType(string $type)
    {
        $values = [
            'string' => 'String',
            'int'    => 123,
            'float'  => -1.23,
            'bool'   => true,
            'null'   => null,
            'array'  => [
                'foo' => 'hello',
                'bar' => 'world',
                0     => 'some string'
            ]
        ];

        return $values[$type];
    }
}