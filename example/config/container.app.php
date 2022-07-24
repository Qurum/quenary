<?php

use App\Domain\ArticleEventTypes;
use App\Domain\Services\ArticleService;
use App\Domain\Services\LoggerService;
use App\Domain\Services\NotifierService;
use App\Infrastructure\Services\ArticleServiceImplementation;
use App\Infrastructure\Services\LoggerServiceImplementation;
use App\Infrastructure\Services\NotifierServiceImplementation;

return [
    ArticleService::class => DI\autowire(ArticleServiceImplementation::class),
    LoggerService::class => DI\autowire(LoggerServiceImplementation::class),
    NotifierService::class => DI\autowire(NotifierServiceImplementation::class),
];