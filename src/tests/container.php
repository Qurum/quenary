<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->addDefinitions(require('config/container.tests.php'));

return $builder->build();