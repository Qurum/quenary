<?php

declare(strict_types=1);

namespace Qurum\Quenary\Core;

abstract class Autoloader
{
    public function __construct(
        protected readonly ConfigManager $configManager,
        protected readonly HandlerManager $handlerManager
    ) {}

    public function dump(): void
    {
        $result['command'] = $this->commands();
        $result['query']   = $this->queries();
        $result['event']  = $this->events();

        $this->configManager->save($result);
    }

    public function load(): array
    {
        return $this->configManager->load();
    }

    abstract protected function commands();
    abstract protected function queries();
    abstract protected function events();
}
