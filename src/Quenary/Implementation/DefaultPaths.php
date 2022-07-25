<?php

declare(strict_types=1);

namespace Quenary\Implementation;

class DefaultPaths extends Paths
{
    public static function YAML_CONFIG(): string
    {
        return getenv('QUENARY_PATH_TO_YAML_CLASSMAP');
    }
}