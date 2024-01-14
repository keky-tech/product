<?php

use Keky\Product\Models\Option;
use Keky\Product\Models\Product;

uses(\Keky\Product\Tests\TestCase::class)->in('Feature');

describe('Basic option tests', function () {
    it('Count default option', function () {
        expect(Option::count())->toBe(0);
    });

    it('Create option by route call', function () {
        $data = Option::factory()->make()->toArray();
        $response = $this->post('/options', $data);
        $response->assertStatus(201);

        $counter = Option::count();

        expect($counter)->toBeInt()->toBeInt()->toBe(1);
    });

    it('Create option by route call with error', function () {
        $data = Option::factory()->make()->toArray();
        $data['title'] = 3000;
        $response = $this->post('/options', $data);
        $response->assertBadRequest();

        $counter = Option::count();

        expect($counter)->toBeInt()->toBeInt()->toBe(0);
    });

    it('First option creation with factories', function () {
        Option::factory()->create();
        expect(Option::count())->toBeInt()->toBe(1);
    });
});

describe('Attach one option to many products', function () {
    it('Sync product with fake option id', function () {
        $products = Product::factory(2)->create();

        $response = $this->post('/options/777/products', [
            'product_ids' => $products->pluck('id')->all(),
        ]);

        $response->assertNotFound();
        expect(Option::count())->toBeInt()->toBe(0);
    });

    it('Sync option with fake product ids', function () {
        $option = Option::factory()->create();
        $response = $this->post('/options/'.$option->id.'/products', [
            'product_ids' => ['356', '95320'],
        ]);

        $response->assertBadRequest();
        expect($option->productsOpt()->count())->toBeInt()->toBe(0);
    });

    it('Sync option with products', function () {
        $option = Option::factory()->create();
        $products = Product::factory(2)->create();

        $response = $this->post('/options/'.$option->id.'/products', [
            'product_ids' => $products->pluck('id')->all(),
        ]);

        $response->assertOk();
        expect($option->productsOpt()->count())->toBeInt()->toBe(2);
    });
});

