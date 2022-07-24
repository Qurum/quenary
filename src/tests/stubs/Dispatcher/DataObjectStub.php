<?php

declare(strict_types=1);

namespace Qenary\Tests\Dispatcher;

class DataObjectStub
{
    public function __construct(
        public readonly string $data
    ){}
}