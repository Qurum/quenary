<?php

declare(strict_types=1);

namespace Qenary\Attributes\Handler;

use Attribute;

#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_METHOD)]
class CommandHandler extends MessageHandler{}