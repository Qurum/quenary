<?php

declare(strict_types=1);

namespace Quenary\Implementation\ClassManager;

enum Messages: string
{
    case GENERATION_STARTED = "Classmap generation started";
    case GENERATION_COMPLETED = "Classmap generation finished.";
}