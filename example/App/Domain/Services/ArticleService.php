<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\ArticleEventTypes;
use Quenary\Attributes\Handler\CommandHandler;

interface ArticleService
{
    #[CommandHandler(ArticleEventTypes::Command)]
    public function publishArticle(PublishAnArticleCommand $article);
}