<?php

namespace Keky\Product\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Keky\Product\Http\Requests\CollectionProductRequest;
use Keky\Product\Http\Requests\CollectionRequest;
use Keky\Product\Models\Collection;
use Keky\Product\Resources\CollectionResource;

class CollectionsController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private Collection $collection)
    {
    }

    public function store(CollectionRequest $collectionRequest): Application|ResponseFactory|FoundationApplication|Response|JsonResponse
    {
        $collection = $this->collection->newQuery()->create($collectionRequest->all());
        if (! ($collection instanceof Collection)) {
            return response('internal_server_error', 500);
        }

        return (new CollectionResource($collection))->response()->setStatusCode(201);
    }

    /**
     * Sync collection to products
     */
    public function attachProducts(CollectionProductRequest $request, int $id): FoundationApplication|Response|Application|ResponseFactory
    {
        // Check if product exist or return 404 error
        $collection = $this->collection->newQuery()->where(['id' => $id])->first();
        if (! $collection) {
            return response('not_found', 404);
        }
        // Sync collection with products
        $products = $collection->products()->sync($request->get('product_ids'));
        if (! empty($products)) {
            return response('success', 200);
        }

        return response('internal_server_error', 500);
    }
}
