<?php

namespace Keky\Product\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Keky\Product\Http\Requests\ProductCollectionRequest;
use Keky\Product\Http\Requests\ProductRequest;
use Keky\Product\Models\Product;
use Keky\Product\Services\ProductService;

class ProductsController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private ProductService $service) {}

    public function store(ProductRequest $productRequest)
    {
        return $this->service->create($productRequest->validated());
    }

    public function update(ProductRequest $productRequest, $product)
    {
        return $this->service->update($product, $productRequest->validated());
    }

    public function delete($product)
    {
        return $this->service->remove($product);
    }

    public function show($product)
    {
        return $this->service->getDetail($product);
    }

    public function index()
    {
        return $this->service->getMany();
    }

    /**
     * Sync product to collections
     */
    // public function attachCollections(ProductCollectionRequest $request, int $id): \Illuminate\Foundation\Application|Response|Application|ResponseFactory
    // {
    //     // Check if product exist or return 404 error
    //     $product = $this->product->newQuery()->where(['id' => $id])->first();
    //     if (! $product) {
    //         return response('not_found', 404);
    //     }
    //     // Sync product with collections
    //     $collections = $product->collections()->sync($request->get('collection_ids'));
    //     if (! empty($collections)) {
    //         return response('success', 200);
    //     }

    //     return response('internal_server_error', 500);
    // }
}
