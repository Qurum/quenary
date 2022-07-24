<?php

declare(strict_types=1);

namespace Qenary\Tests\DataObject;

class DataObjectStub
{
    public function __construct(
        public readonly ?string $string,
        public readonly int     $int,
        public readonly bool    $bool,
        public readonly float   $float
    ) {}
}