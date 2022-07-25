<?php

declare(strict_types=1);

namespace Qenary\Implementation\ClassManager;

class Composer
{
    private const COMMAND          = 'composer dump-autoload --optimize --no-dev';
    private const PATH_TO_CLASSMAP = __DIR__ .'/vendor/composer/autoload_classmap.php';

    public function execute()
    {
        exec(self::COMMAND);
    }

    public function classes()
    {
        return array_keys(require(self::PATH_TO_CLASSMAP));
    }
}