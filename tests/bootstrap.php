<?php

declare(strict_types=1);

require 'vendor/autoload.php';

$container = require 'tests/container.php';

function container(?string $className)
{
    global $container;

    return is_null($className) ? $container : $container->get($className);
}