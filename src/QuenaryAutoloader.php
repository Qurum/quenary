<?php

declare(strict_types=1);

namespace Quenary;

use Quenary\Core\Autoloader;

interface QuenaryAutoloader { public static function autoloader(): Autoloader; }