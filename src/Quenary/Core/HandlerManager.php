<?php

declare(strict_types=1);

namespace Quenary\Core;

interface HandlerManager
{
    public function getCommandHandlers();
    public function getQueryHandlers();
    public function getEventHandlers();
}