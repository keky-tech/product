<?php

namespace Keky\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Keky\Product\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $title = fake()->text(rand(20, 150));
        $statues = $this->getProductStatues();
        $sizeDefinition = rand(0, 1);

        return [
            'title' => $title,
            'subtitle' => rand(0, 1) ? fake()->text(rand(20, 80)) : null,
            'description' => rand(0, 1) ? fake()->text(rand(20, 250)) : null,
            'slug' => Str::slug($title),
            'status' => $statues[rand(0, 2)],
            'external_id' => Str::uuid(),
            'thumbnail' => rand(0, 1) ? 'https://placehold.co/600x400' : null,
            'weight' => $sizeDefinition ? rand(1, 100) : null,
            'height' => $sizeDefinition ? rand(1, 100) : null,
            'width' => $sizeDefinition ? rand(1, 100) : null,
            'type_id' => rand(0, 1) ? uniqid() : null,
            'metadata' => rand(0, 1) ? '{"key":"value"}' : null,
        ];
    }

    /**
     * @return string[]
     */
    private function getProductStatues(): array
    {
        return ['draft', 'published', 'rejected'];
    }

    public function published(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'published',
            ];
        });
    }
}
