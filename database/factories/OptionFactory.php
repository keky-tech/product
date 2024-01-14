<?php

namespace Keky\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Keky\Product\Models\Option;

class OptionFactory extends Factory
{
    protected $model = Option::class;

    public function definition(): array
    {
        return [
            'title' => fake()->text(rand(10, 150)),
        ];
    }
}
