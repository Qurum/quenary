<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\ArticleEventTypes;
use App\Domain\Services\NewArticleEvent;
use App\Domain\Services\NotifierService;
use Monolog\Logger;
use Quenary\Attributes\Handler\EventHandler;

class NotifierServiceImplementation implements NotifierService
{
    public function __construct(private readonly Logger $logger) {}

    #[EventHandler(ArticleEventTypes::Event)] public function newArticleEventHandler(NewArticleEvent $event)
    {
        $this->logger->info('О появлении статьи ' . $event->title . ' было послано письмо.');
    }
}