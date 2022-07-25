<?php

declare(strict_types=1);

namespace Quenary\Implementation;

use DateTimeImmutable;
use \Spyc;

class ConfigManager implements \Quenary\Core\ConfigManager
{
    public function __construct(public readonly Paths $paths) {}

    public function load(): array
    {
        return Spyc::YAMLLoad($this->paths::YAML_CONFIG);
    }

    public function save(array $data): void
    {
        $header = sprintf(
            "# Event Bus handler map file\n# %s\n\n",
            (new DateTimeImmutable('now'))->format('Y-m-d H:i:s')
        );

        $output = Spyc::YAMLDump(
            array            : $data,
            no_opening_dashes: true,
        );

        file_put_contents($this->paths::YAML_CONFIG, $header . $output);
    }
}