<?php

declare(strict_types=1);

namespace App\Domain\Services;

class PublishAnArticleCommand
{
    public function __construct(
        public readonly string $title,
        public readonly string $text,
        public readonly string $author,
    ){}
}