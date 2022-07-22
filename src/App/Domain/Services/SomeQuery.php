<?php

declare(strict_types=1);

namespace App\Domain\Services;

class SomeQuery
{
    public function __construct(
        public readonly string $payload
    ){}
}