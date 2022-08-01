<?php

declare(strict_types=1);

namespace Qenary\Implementation;

class Paths
{
    private const ENV_PATH_TO_YAML_CONFIG          = 'QUENARY_PATH_TO_YAML_CONFIG';

    public readonly string $PATH_TO_YAML_CONFIG;

    public function __construct()
    {
        $this->PATH_TO_YAML_CONFIG = getenv(self::ENV_PATH_TO_YAML_CONFIG) === false
            ? './tmp/eb1bf189-11d7-48ec-94ea-2cf07a36e782.eventbus.yaml'
            : getenv(self::ENV_PATH_TO_YAML_CONFIG);
    }
}