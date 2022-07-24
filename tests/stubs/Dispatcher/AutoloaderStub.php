<?php

declare(strict_types=1);

namespace Qenary\Tests\Dispatcher;

use Qenary\Core\Autoloader;

class AutoloaderStub extends Autoloader
{
    protected function commands() {}

    protected function queries() {}

    protected function events() {}

    public function load(): array
    {
        return [
            'event'   => [
                EventTypes::RED_EVENT->value => [
                    [
                        'class'   => SomeService::class,
                        'method'  => 'redEvent',
                        'event' => DataObjectStub::class,
                    ]
                ]
            ],
            'command' => [
                EventTypes::BAR_COMMAND->value => [
                    [
                        'class'   => SomeService::class,
                        'method'  => 'barCommand',
                        'command' => DataObjectStub::class,
                    ]
                ]
            ],
            'query'   => [
                EventTypes::GREEN_QUERY->value => [
                    [
                        'class'   => SomeService::class,
                        'method'  => 'greenQuery',
                        'query' => DataObjectStub::class,
                    ]
                ]
            ]
        ];
    }
}