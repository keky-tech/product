<?php

namespace Keky\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Keky\Product\Models\Collection;

class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    public function definition(): array
    {
        $title = fake()->text(rand(20, 200));

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'metadata' => rand(0, 1) ? '{"key":"value"}' : null,
        ];
    }
}
