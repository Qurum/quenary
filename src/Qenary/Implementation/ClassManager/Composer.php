<?php

declare(strict_types=1);

namespace Qenary\Implementation\ClassManager;

class Composer
{
    private readonly string $COMMAND;
    private readonly string $PATH_TO_CLASSMAP;

    private const ENV_COMMAND          = 'QUENARY_COMMAND';
    private const ENV_PATH_TO_CLASSMAP = 'QUENARY_PATH_TO_CLASSMAP';

    public function __construct()
    {
        $this->COMMAND = getenv(self::ENV_COMMAND) === false
            ? 'composer dump-autoload --optimize --no-dev'
            : getenv(self::ENV_COMMAND);

        $this->PATH_TO_CLASSMAP = getenv(self::ENV_PATH_TO_CLASSMAP) === false
            ? 'vendor/composer/autoload_classmap.php'
            : getenv(self::ENV_PATH_TO_CLASSMAP);
    }

    public function execute()
    {
        exec($this->COMMAND);
    }

    public function classes()
    {
        return array_keys(require($this->PATH_TO_CLASSMAP));
    }
}