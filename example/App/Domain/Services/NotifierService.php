<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\ArticleEventTypes;
use Quenary\Attributes\Handler\CommandHandler;
use Quenary\Attributes\Handler\EventHandler;

interface NotifierService
{
    #[EventHandler(ArticleEventTypes::Event)]
    public function newArticleEventHandler(NewArticleEvent $event);
}