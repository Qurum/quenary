<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\ArticleEventTypes;
use Qenary\Attributes\Handler\EventHandler;

interface LoggerService
{
    #[EventHandler(ArticleEventTypes::Event)]
    public function newArticleEventHandler(NewArticleEvent $event);
}