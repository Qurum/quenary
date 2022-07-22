<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\ArticleEventTypes;
use App\Domain\Services\LoggerService;
use App\Domain\Services\NewArticleEvent;
use App\Domain\Services\NotifierService;
use Monolog\Logger;
use Qenary\Attributes\Handler\EventHandler;

class LoggerServiceImplementation implements LoggerService
{
    public function __construct(private readonly Logger $logger) {}

    #[EventHandler(ArticleEventTypes::Event)] public function newArticleEventHandler(NewArticleEvent $event)
    {
        $this->logger->info('Опубликована статья ' . $event->title . '.');
    }
}