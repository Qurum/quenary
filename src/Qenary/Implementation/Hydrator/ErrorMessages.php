<?php

declare(strict_types=1);

namespace Qurum\Quenary\Implementation\Hydrator;

enum ErrorMessages: string
{
    case ClassDoesNotExist = '%s does not exist';
    case CannotInstantiate = '%s cannot be instantiated without calling the constructor';
    case Hydration_NoProperty = '%s has no property %s';
    case Hydration_WrongType = 'Type mismatch: %s of type %s supplied to %s, expected %s';
    case Hydration_NotAllowNull = '%s of type %s does not allow null';
    case WrongJson = 'Can\'t parse JSON';
}