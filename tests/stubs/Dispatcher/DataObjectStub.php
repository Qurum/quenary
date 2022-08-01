<?php

declare(strict_types=1);

namespace Quenary\Tests\Dispatcher;

class DataObjectStub
{
    public function __construct(
        public readonly string $data
    ){}
}