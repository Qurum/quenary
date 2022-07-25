<?php

declare(strict_types=1);

namespace Quenary\Core;

interface ConfigManager
{
    public function load(): array;

    public function save(array $data): void;
}