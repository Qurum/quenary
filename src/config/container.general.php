<?php

use Monolog\Handler\StreamHandler as MonologStreamHandler;
use Monolog\Logger;

return [
    /* Monolog setup */
    'MonologConsoleStreamHandler' => DI\autowire(MonologStreamHandler::class)
        ->constructor('php://stdout', Logger::INFO),

    Logger::class                 => DI\autowire(Logger::class)
        ->constructorParameter('name', DI\env('LOG_CHANNEL'))
        ->method('pushHandler', DI\get('MonologConsoleStreamHandler')),
];