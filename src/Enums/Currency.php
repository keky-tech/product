<?php

namespace Keky\Product\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum Currency: string
{
    use InvokableCases, Values;

    case XOF = 'XOF';
}
