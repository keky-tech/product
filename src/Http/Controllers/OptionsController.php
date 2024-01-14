<?php

namespace Keky\Product\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Keky\Product\Http\Requests\OptionProductRequest;
use Keky\Product\Http\Requests\OptionRequest;
use Keky\Product\Models\Option;
use Symfony\Component\HttpFoundation\Response;

class OptionsController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private Option $option)
    {
    }

    public function store(OptionRequest $optionRequest)
    {
        $option = $this->option->newQuery()->create($optionRequest->all());
        if (! ($option instanceof Option)) {
            return response()->json([
                'success' => 'failed',
                'message' => 'Internal server error !',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'success' => 'ok',
            'data' => $option->toArray(),
        ], Response::HTTP_CREATED);
    }


    public function attachProducts(OptionProductRequest $request, int $id): FoundationApplication|\Illuminate\Http\Response|Application|ResponseFactory
    {
        $option = $this->option->newQuery()->where(['id' => $id])->first();
        if (! $option) {
            return response('not_found', 404);
        }
        $products = $option->productsOpt()->sync($request->get('product_ids'));
        if (! empty($products)) {
            return response('success', 200);
        }

        return response('internal_server_error', 500);
    }

}
