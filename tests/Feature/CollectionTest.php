<?php

use Keky\Product\Models\Collection;
use Keky\Product\Models\Product;

uses(\Keky\Product\Tests\TestCase::class)->in('Feature');

describe('Collection creation tests suite', function () {
    it('Count default collection', function () {
        expect(Collection::count())->toBe(0);
    });

    it('Create collection by route call', function () {
        $data = Collection::factory()->make()->toArray();
        $response = $this->post('/collections', $data);
        $response->assertStatus(201);

        $counter = Collection::count();

        expect($counter)->toBeInt()->toBeInt()->toBe(1);
    });

    it('Create collection and expect unprocessable entity response', function () {
        $data = Collection::factory()->make()->toArray();
        $data['title'] = 4000;
        $response = $this->post('/collections', $data);
        $response->assertBadRequest();
        $counter = Collection::count();
        expect($counter)->toBeInt()->toBeInt()->toBe(0);
    });

    it('create collection and sync products', function () {
        $collection = Collection::factory()->create();
        $products = Product::factory(7)->create();

        $response = $this->post('/collections/'.$collection->id.'/products', [
            'product_ids' => $products->pluck('id')->all(),
        ]);

        $response->assertOk();
        expect($products->get(0)->collections()->count())->toBeInt()->toBe(1);
        expect($collection->products()->count())->toBeInt()->toBe(7);
    });

    it('create collection with does not exist collection', function () {
        $products = Product::factory(7)->create();

        $response = $this->post('/collections/77777/products', [
            'product_ids' => $products->pluck('id')->all(),
        ]);

        $response->assertNotFound();
        expect($products->get(0)->collections()->count())->toBeInt()->toBe(0);
    });

    it('create collection with fake product ids', function () {
        $collection = Collection::factory()->create();

        $response = $this->post('/collections/'.$collection->id.'/products', [
            'product_ids' => [3000, '4000', 85052],
        ]);

        $response->assertBadRequest();
    });
});
