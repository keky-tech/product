<?php

namespace Keky\Product\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum ProductUnit: string
{
    use InvokableCases, Values;

    case PIECE = 'pcs';
}
