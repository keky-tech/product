<?php

use Keky\Product\Models\Collection;
use Keky\Product\Models\Option;
use Keky\Product\Models\Product;

uses(\Keky\Product\Tests\TestCase::class)->in('Feature');

describe('Basic product tests', function () {
    it('Count default product', function () {
        expect(Product::count())->toBe(0);
    });

    it('Create product by route call', function () {
        $data = Product::factory()->make()->toArray();
        $response = $this->post('/products', $data);
        $response->assertStatus(201);

        $counter = Product::count();

        expect($counter)->toBeInt()->toBeInt()->toBe(1);
    });

    it('Create product by route call with error', function () {
        $data = Product::factory()->make()->toArray();
        $data['width'] = 'test';
        $data['metadata'] = 4000;
        $response = $this->post('/products', $data);
        $response->assertStatus(422);

        $counter = Product::count();

        expect($counter)->toBeInt()->toBeInt()->toBe(0);
    });

    it('First product creation with factories', function () {
        Product::factory()->create();
        expect(Product::count())->toBeInt()->toBe(1);
    });
});

describe('Products update tests', function () {
    it('can update a product with valid data', function () {
        // Create an existing product
        $product = Product::factory()->make()->toArray();
        $response = $this->post('/products', $product);
        $response = json_decode($response->getContent());
        $product = $response->data;

        // Valid update data
        $data = [
            'title' => 'New title',
            'status' => 'published',
            // Add other update fields if necessary
        ];

        // Send the update request
        $response = $this->put("/products/{$product->id}", $data);

        // Ensure the response is 200 OK
        $response->assertOk();

        // Ensure the product data has been updated in the database
        $this->assertDatabaseHas('products', $data);
    });

    it('returns a 404 error if the product does not exist', function () {
        // Non-existent ID
        $nonExistentProductId = 999;

        // Valid update data
        $data = [
            'title' => 'New title',
            'status' => 'published',
            // Add other update fields if necessary
        ];

        // Send the update request
        $response = $this->put("/products/{$nonExistentProductId}", $data);

        // Ensure the response is 404 Not Found
        $response->assertNotFound();
    });

    it('returns a 422 error if the update data is invalid', function () {
        // Create an existing product
        $product = Product::factory()->create();

        // Invalid update data (e.g., missing title)
        $invalidData = [
            'status' => 'progress',
            // Add other update fields if necessary
        ];

        // Send the update request
        $response = $this->put("/products/{$product->id}", $invalidData);

        // Ensure the response is a validation error (422 Unprocessable Entity)
        $response->assertStatus(422);
    });
});

describe('product delete', function () {
    it('can delete a product', function () {
        // Create an existing product
        $product = Product::factory()->create();

        // Send the delete request
        $response = $this->delete("/products/{$product->id}");

        // Ensure the response is 204 No Content (successful delete)
        $response->assertOk();

        // Ensure the product has been removed from the database
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    });

    it('returns a 404 error if trying to delete a non-existent product', function () {
        // Non-existent ID
        $nonExistentProductId = 999;

        // Send the delete request for a non-existent product
        $response = $this->delete("/products/{$nonExistentProductId}");

        // Ensure the response is 404 Not Found
        $response->assertNotFound();
    });

    it('can create and delete products, then verify the count', function () {
        // Number of products to create
        $numberOfProducts = 5;

        // Create multiple products
        $createdProducts = Product::factory()->createMany($numberOfProducts);

        // Delete some products (e.g., delete the first two)
        $productsToDelete = $createdProducts->take(2);
        foreach ($productsToDelete as $product) {
            $response = $this->delete("/products/{$product->id}");
            $response->assertOk();
        }

        // Verify if the count matches the expected number after deletions
        expect($numberOfProducts - $productsToDelete->count())->toBeInt()->toBe(Product::count());
    });
});

describe('Products with collections', function () {
    it('Sync collections with fake product id', function () {
        $collections = Collection::factory(3)->create();

        $response = $this->post('/products/787878/collections', [
            'collection_ids' => $collections->pluck('id')->all(),
        ]);

        $response->assertNotFound();
        expect(Product::count())->toBeInt()->toBe(0);
    });

    it('Sync product collections with fake collection ids', function () {
        $product = Product::factory()->create();
        $response = $this->post('/products/'.$product->id.'/collections', [
            'collection_ids' => ['884', '952000', 88787],
        ]);

        $response->assertBadRequest();
        expect($product->collections()->count())->toBeInt()->toBe(0);
    });

    it('Sync product with collections', function () {
        $product = Product::factory()->create();
        $collections = Collection::factory(4)->create();

        $response = $this->post('/products/'.$product->id.'/collections', [
            'collection_ids' => $collections->pluck('id')->all(),
        ]);

        $response->assertOk();
        expect($product->collections()->count())->toBeInt()->toBe(4);
    });
});


describe('Attach one product to many options', function () {
    it('Sync option with fake product id', function () {
        $options = Option::factory(2)->create();

        $response = $this->post('/products/777/options', [
            'option_ids' => $options->pluck('id')->all(),
        ]);

        $response->assertNotFound();
        expect(Product::count())->toBeInt()->toBe(0);
    });

    it('Sync product options with fake option ids', function () {
        $product = Product::factory()->create();
        $response = $this->post('/products/'.$product->id.'/options', [
            'option_ids' => ['778', '65890'],
        ]);

        $response->assertBadRequest();
        expect($product->options()->count())->toBeInt()->toBe(0);
    });

    it('Sync product with options', function () {
        $product = Product::factory()->create();
        $options = Option::factory(2)->create();

        $response = $this->post('/products/'.$product->id.'/options', [
            'option_ids' => $options->pluck('id')->all(),
        ]);

        $response->assertOk();
        expect($product->options()->count())->toBeInt()->toBe(2);
    });
});

