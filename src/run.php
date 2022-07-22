<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Application\Controller;
use App\Domain\ArticleEventTypes;
use DI\ContainerBuilder;
use Qenary\Core\Dispatcher;

$container = require 'container.php';

$controller = $container->get(Controller::class);
$controller->doAction();
//($dispatcher->dispatch(ArticleEventTypes::Command->value, '{"value": "Hey-ho!"}'));
//($dispatcher->dispatch(ArticleEventTypes::Query->value, '{"payload": "Hey-ho-ho!"}'));
//($dispatcher->dispatch(ArticleEventTypes::Event->value, '{"payload": "Hey-ho-ho-hey!"}'));