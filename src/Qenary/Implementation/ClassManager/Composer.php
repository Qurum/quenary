<?php

declare(strict_types=1);

namespace Qenary\Implementation\ClassManager;

enum Composer: string
{
    case COMMAND = 'composer dump-autoload --optimize --no-dev';
    case PATH_TO_CLASSMAP = 'vendor/composer/autoload_classmap.php';
}