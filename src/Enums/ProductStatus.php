<?php

namespace Keky\Product\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum ProductStatus: string
{
    use InvokableCases, Values;

    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case REJECTED = 'rejected';
}
