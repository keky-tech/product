<?php

namespace Keky\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Keky\Product\Models\Option;
use Keky\Product\Models\OptionValue;

class OptionValueFactory extends Factory
{
    protected $model = OptionValue::class;

    public function definition(): array
    {
        return [
            'value' => fake()->text(rand(20, 150)),
            'metadata' => rand(0, 1) ? '{"key":"value"}' : null,
            'option_id' => Option::factory(),
        ];
    }
}
