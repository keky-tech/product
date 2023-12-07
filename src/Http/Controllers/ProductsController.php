<?php

namespace Keky\Product\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Keky\Product\Http\Requests\ProductCollectionRequest;
use Keky\Product\Http\Requests\ProductRequest;
use Keky\Product\Models\Product;

class ProductsController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private Product $product)
    {
    }

    public function store(ProductRequest $productRequest)
    {
        $product = $this->product->newQuery()->create($productRequest->all());
        if (! ($product instanceof Product)) {
            return response()->json([
                'success' => 'failed',
                'message' => 'Something went wrong. Please retry!',
            ], 500);
        }

        return response()->json([
            'success' => 'ok',
            'data' => $product->toArray(),
        ], 201);
    }

    public function update(ProductRequest $productRequest, int $id): JsonResponse
    {
        // Check if product exist or return 404 error
        $product = $this->product->newQuery()->where(['id' => $id])->first();
        if (! $product) {
            return response()->json([
                'success' => 'failed',
                'message' => 'The product you are looking for does not exist',
            ], 404);
        }
        // Update product and Check if an error occurred
        if ($product->update($productRequest->all())) {
            // Return success response
            return response()->json([
                'success' => 'ok',
                'data' => $product->toArray(),
            ]);
        }

        // Return failed response
        return response()->json([
            'success' => 'failed',
            'message' => 'Something went wrong. Please retry!',
        ], 500);
    }

    public function destroy(int $id): \Illuminate\Foundation\Application|Response|Application|ResponseFactory
    {
        // Check if product exist or return 404 error
        $product = $this->product->newQuery()->where(['id' => $id])->first();
        if (! $product) {
            return response('not_found', 404);
        }
        // Delete product and Check if an error occurred
        if ($product->delete()) {
            // Return success response
            return response('success', 200);
        }

        // Return failed response
        return response('internal_server_error', 500);
    }

    /**
     * Sync product to collections
     */
    public function attachCollections(ProductCollectionRequest $request, int $id): \Illuminate\Foundation\Application|Response|Application|ResponseFactory
    {
        // Check if product exist or return 404 error
        $product = $this->product->newQuery()->where(['id' => $id])->first();
        if (! $product) {
            return response('not_found', 404);
        }
        // Sync product with collections
        $collections = $product->collections()->sync($request->get('collection_ids'));
        if (! empty($collections)) {
            return response('success', 200);
        }

        return response('internal_server_error', 500);
    }
}
