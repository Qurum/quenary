<?php

declare(strict_types=1);

namespace Qurum\Quenary\Attributes\Handler;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_METHOD)]
class CommandHandler extends MessageHandler{}