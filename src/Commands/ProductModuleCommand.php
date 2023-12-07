<?php

namespace Keky\Product\Commands;

use Illuminate\Console\Command;

class ProductModuleCommand extends Command
{
    public $signature = 'product-module';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
