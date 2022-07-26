<?php

declare(strict_types=1);

namespace Quenary\Core\Hydrator;

interface Hydrator
{
    public function hydrate(string $className, string $json): object;
}