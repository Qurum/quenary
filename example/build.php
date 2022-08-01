<?php

declare(strict_types=1);

use Quenary\Core\Autoloader;

require 'vendor/autoload.php';

$container = require 'container.php';

$container->get(Autoloader::class)->dump();