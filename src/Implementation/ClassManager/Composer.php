<?php

declare(strict_types=1);

namespace Quenary\Implementation\ClassManager;

class Composer
{
    private const COMMAND          = 'composer dump-autoload --optimize --no-dev';

    public function execute()
    {
        exec(self::COMMAND);
    }

    public function classes()
    {
        return array_keys(require(getenv('QENARY_PATH_TO_CLASSMAP')));
    }
}