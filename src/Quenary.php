<?php

declare(strict_types=1);

namespace Quenary;

interface Quenary { public static function dispatch(string $type, ?string $json); }