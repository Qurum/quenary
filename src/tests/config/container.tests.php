<?php

declare(strict_types=1);

use Qenary\Core\Hydrator\Hydrator;
use Qenary\Implementation\Hydrator\Hydrator as HydratorImplementation;

return [
    Hydrator::class => DI\autowire(HydratorImplementation::class),
];
