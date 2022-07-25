<?php

declare(strict_types=1);

namespace Quenary\Tests\Autoloader;

use Quenary\Core\ConfigManager;

class ConfigManagerStub implements ConfigManager
{
    private static ConfigManager $mock;

    public static function injectMock(ConfigManager $mock)
    {
        self::$mock = $mock;
    }

    public function load(): array
    {
        return $this->data();
    }

    public function save(array $data): void
    {
        self::$mock->save($data);
    }

    public function data()
    {
        return [
            'command' => [
                'someCommandType1' => [
                    (object)[
                        'class'   => 'SomeInterface',
                        'method'  => 'someMethod',
                        'command' => 'SomeDataObject'
                    ]
                ],
                'someCommandType2' => [
                    (object)[
                        'class'   => 'SomeInterface1',
                        'method'  => 'someMethod',
                        'command' => 'SomeDataObject'
                    ],
                    (object)[
                        'class'   => 'SomeInterface2',
                        'method'  => 'someMethod',
                        'command' => 'SomeDataObject'
                    ]
                ]
            ],
            'event'   => [
                'someEventType' => [
                    (object)[
                        'class'  => 'SomeInterface',
                        'method' => 'someMethod',
                        'event'  => 'SomeDataObject'
                    ]
                ]
            ],
            'query'   => []
        ];
    }
}