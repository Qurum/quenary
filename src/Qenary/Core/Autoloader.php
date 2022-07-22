<?php

declare(strict_types=1);

namespace Qenary\Core;

abstract class Autoloader
{
    public function __construct(
        private readonly ConfigManager $configManager,
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
