<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Application\Controller;
use App\Domain\ArticleEventTypes;
use DI\ContainerBuilder;
use Quenary\Core\Dispatcher;

$container = require 'container.php';

$controller = $container->get(Controller::class);
$controller->doAction();