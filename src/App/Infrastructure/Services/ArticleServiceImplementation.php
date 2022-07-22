<?php

namespace App\Infrastructure\Services;

use App\Domain\ArticleEventTypes;
use App\Domain\Services\ArticleService;
use App\Domain\Services\NewArticleEvent;
use App\Domain\Services\PublishAnArticleCommand;
use Qenary\Attributes\Handler\CommandHandler;
use Qenary\Core\Dispatcher;

class ArticleServiceImplementation implements ArticleService
{
    public function __construct(private readonly Dispatcher $dispatcher) {}

    #[CommandHandler(ArticleEventTypes::Command)]
    public function commandHandler(PublishAnArticleCommand $article)
    {
        echo "Получена команда на публикацию статьи", PHP_EOL;
        echo "Автор: ", $article->author, PHP_EOL;
        echo "Название:  ", $article->title, PHP_EOL;
        echo "Текст: ", PHP_EOL, $article->text, PHP_EOL;
        echo "Статья опубликована.", PHP_EOL, PHP_EOL;

        $this->dispatcher->dispatch(
            ArticleEventTypes::Event->value,
            json_encode(new NewArticleEvent($article->title))
        );
    }
}
