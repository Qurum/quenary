<?php

declare(strict_types=1);

namespace Qurum\Quenary\Core;

interface ConfigManager
{
    public function load(): array;

    public function save(array $data): void;
}