<?php

declare(strict_types=1);

namespace App\Domain\Services;

class NewArticleEvent
{
    public function __construct(
        public readonly string $title
    ) {}
}