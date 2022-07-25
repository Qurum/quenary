<?php

declare(strict_types=1);

namespace Quenary\Core;

use Generator;
use ReflectionClass;

interface ClassManager
{
    /**
     * Get all known interfaces.
     *
     * @return Generator|ReflectionClass[]
     */
    public function interfaces(): Generator;
}