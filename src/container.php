<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->addDefinitions(require('config/container.general.php'));
$builder->addDefinitions(require('config/container.quenary.php'));
$builder->addDefinitions(require('config/container.app.php'));

return $builder->build();