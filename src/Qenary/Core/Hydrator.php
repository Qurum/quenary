<?php

declare(strict_types=1);

namespace Qenary\Core;

interface Hydrator
{
    public function hydrate(string $className, string $json): object;
}