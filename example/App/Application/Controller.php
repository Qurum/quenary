<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\ArticleEventTypes;
use App\Domain\Services\PublishAnArticleCommand;
use Quenary\Core\Dispatcher;

class Controller
{
    public function __construct(private readonly Dispatcher $dispatcher) {}

    public function doAction(): void
    {
        $this->dispatcher->dispatch(
            ArticleEventTypes::Command->value,
            json_encode(
                new PublishAnArticleCommand(
                    'Хульдуфоулк',
                    'Наступает рождество. Пора менять дома.',
                    'anonymous'
                )
            )
        );
    }
}